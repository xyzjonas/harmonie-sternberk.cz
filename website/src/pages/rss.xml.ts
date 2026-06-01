import rss from '@astrojs/rss';
import { getCollection } from 'astro:content';
import { SITE_TITLE, SITE_DESCRIPTION } from '../consts';
import type { APIContext } from 'astro';

export async function GET(context: APIContext) {
	const events = await getCollection('events');
	return rss({
		title: SITE_TITLE,
		description: SITE_DESCRIPTION,
		site: context.site!,
		items: events
			.sort((a, b) => b.data.datetime.valueOf() - a.data.datetime.valueOf())
			.map((event) => ({
				title: event.data.title,
				description: event.data.description,
				pubDate: event.data.datetime,
				link: `/events/${event.id}/`,
			})),
		customData: `<language>cs</language>`,
	});
}
