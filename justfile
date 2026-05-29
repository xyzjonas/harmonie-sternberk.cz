
[working-directory: 'website']
dev:
  npm run dev

[working-directory: 'website']
build:
  npm run build

# Convert image to optimized WebP format
# Usage: just optimize-image path/to/image.png
optimize-image IMG:
  #!/usr/bin/env bash
  set -euo pipefail

  # Check if file exists
  if [ ! -f "{{IMG}}" ]; then
    echo "Error: File '{{IMG}}' not found"
    exit 1
  fi

  # Get file info
  input_file="{{IMG}}"
  input_dir=$(dirname "$input_file")
  input_base=$(basename "$input_file")
  input_name="${input_base%.*}"
  output_file="${input_dir}/${input_name}.webp"

  # Get original size
  original_size=$(du -h "$input_file" | cut -f1)

  echo "Converting: $input_file"
  echo "Output: $output_file"
  echo "Original size: $original_size"
  echo ""

  # Convert with optimal settings
  magick "$input_file" \
    -quality 85 \
    -define webp:method=6 \
    "$output_file"

  # Show results
  new_size=$(du -h "$output_file" | cut -f1)
  echo ""
  echo "✓ Conversion complete!"
  echo "  Original: $original_size"
  echo "  Optimized: $new_size"
  echo "  Saved to: $output_file"

# Convert all PNG/JPG images in a directory to WebP
# Usage: just optimize-dir path/to/directory
optimize-dir DIR:
  #!/usr/bin/env bash
  set -euo pipefail

  if [ ! -d "{{DIR}}" ]; then
    echo "Error: Directory '{{DIR}}' not found"
    exit 1
  fi

  echo "Finding images in {{DIR}}..."
  count=0

  # Find all PNG and JPG files
  while IFS= read -r -d '' file; do
    echo ""
    echo "[$((++count))] Processing: $file"
    just optimize-image "$file"
  done < <(find "{{DIR}}" -type f \( -iname "*.png" -o -iname "*.jpg" -o -iname "*.jpeg" \) -print0)

  echo ""
  echo "✓ Completed $count image(s)"

# Show size comparison between PNG/JPG originals and WebP versions
compare-sizes DIR:
  #!/usr/bin/env bash
  echo "Image size comparison in {{DIR}}:"
  echo ""
  echo "Original images:"
  find "{{DIR}}" -type f \( -iname "*.png" -o -iname "*.jpg" -o -iname "*.jpeg" \) -exec du -h {} + | sort -h
  echo ""
  echo "WebP versions:"
  find "{{DIR}}" -type f -iname "*.webp" -exec du -h {} + | sort -h

