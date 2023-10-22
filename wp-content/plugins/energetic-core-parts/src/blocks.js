/**
 * WordPress dependencies
 */
const {
    registerBlockType
} = wp.blocks;

// Category slug and title
const category = {
    slug: 'etblocks',
    title: 'ET Blocks',
};

// Custom foreground icon color based on the CoBlocks branding
const iconColor = '#1e35b9';

/**
 * Gutenberg Blocks
 */

// register block category.
import "./blocks/utils/block-category";
// Comman block style
import "./editor.scss";
// // expanding blocks
import "./blocks/utils/style-options";

// // Register Blocks

import * as authors from './blocks/authors';
import * as testimonial from './blocks/testimonial';
import * as accordion from "./blocks/accordion";
import * as accordion_item from "./blocks/accordion-item";
import * as posts from "./blocks/posts";
import * as posts_carousel from "./blocks/posts-carousel";
import * as posts_list from "./blocks/posts-list";
import * as portfolio from "./blocks/portfolio";
import * as team from "./blocks/team";
import * as pricing_table from "./blocks/pricing-table";
import * as pricing_table_item from "./blocks/pricing-table-item";

import * as icon from "./blocks/icon";
import * as icon_item from "./blocks/icon-item";
import * as instagram from "./blocks/instagram";
import * as categories from "./blocks/categories";

export function registerBlocks() {
    [
        accordion,
        accordion_item,
        authors, 
        categories, 
        icon,
        icon_item, 
        instagram, 
        portfolio,
        posts,
        posts_carousel,
        posts_list,
        pricing_table,
        pricing_table_item,
        testimonial,
        team

    ].forEach((block) => {

        if (!block) {
            return;
        }

        const {
            name,
            icon,
            settings
        } = block;

        registerBlockType(`energetic-core-parts/${ name }`, {
            category: category.slug,
            icon: {
                src: icon,
                foreground: iconColor,
            },
            ...settings
        });
    });
};
registerBlocks();