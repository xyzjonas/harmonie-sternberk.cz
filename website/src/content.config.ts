import { defineCollection } from 'astro:content';
import { glob } from 'astro/loaders';
import { z } from 'astro/zod';

const events = defineCollection({
	loader: glob({ base: './src/content/events', pattern: '**/*.{md,mdx}' }),
	schema: z.object({
		title: z.string(),
		description: z.string(),
		datetime: z.coerce.date(),
		hasTime: z.boolean().optional(),
		location: z.string().optional(),
		heroImage: z.string().optional(),
		poster: z.string().optional(),
		highlight: z.boolean().optional(),
		presalePrice: z.string().optional(),
		spotPrice: z.string().optional(),
		additionalInfo: z.string().optional(),
	}),
});

const proCleny = defineCollection({
	loader: glob({ base: './src/content/pro-cleny', pattern: '**/*.{md,mdx}' }),
	schema: z.object({
		title: z.string(),
		subtitle: z.string().optional(),
		datetime: z.coerce.date(),
		isPinned: z.boolean().optional(),
	}),
});

export const collections = { events, proCleny };
