<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCatalogSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Adaptogens
            [
                'name' => 'Aurora Adaptogenic Drops',
                'category' => 'adaptogens',
                'summary' => 'Daily tincture featuring holy basil, schisandra, and rhodiola for calm focus.',
                'description' => 'Our Aurora Drops fold adaptogenic botanicals into organic glycerin for fast absorption. A citrus peel finish keeps each serving bright while reishi and rhodiola stack to soften daily stress spikes.',
                'price' => 38,
                'inventory' => 160,
                'image_url' => 'https://images.unsplash.com/photo-1498843053639-170ff2122f35?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'name' => 'Lumen Matcha Nootropic',
                'category' => 'adaptogens',
                'summary' => 'Ceremonial matcha stacked with lion’s mane and MCT for clean energy.',
                'description' => 'Shade-grown matcha from Uji is whisked with lion’s mane extract, pine pollen, and cold-pressed MCT to sustain focus without the crash. Great hot or shaken over ice.',
                'price' => 36,
                'inventory' => 140,
                'image_url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'name' => 'Golden Hour Mushroom Gummies',
                'category' => 'adaptogens',
                'summary' => 'Tangerine gummies infused with cordyceps and lion’s mane for uplift.',
                'description' => 'These vegan gummies pair cordyceps, lion’s mane, and vitamin B6 with cold-pressed citrus. A portable way to keep energy smooth on busy days.',
                'price' => 34,
                'inventory' => 180,
                'image_url' => 'https://images.unsplash.com/photo-1502759683299-cdcd6974244f?q=80&w=1200&auto=format&fit=crop',
            ],

            // Skincare
            [
                'name' => 'Citrine Glow Facial Nectar',
                'category' => 'skincare',
                'summary' => 'Vitamin C oil serum with sea buckthorn and prickly pear.',
                'description' => 'A concentrated nectar that fuses sea buckthorn, prickly pear, and stabilized vitamin C with fermented calendula. Lightweight yet cushiony for a dewy finish.',
                'price' => 58,
                'inventory' => 95,
                'image_url' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'name' => 'Celestine Magnesium Balm',
                'category' => 'skincare',
                'summary' => 'Topical balm with blue tansy and magnesium chloride for muscle relief.',
                'description' => 'Magnesium chloride saturates tired muscles while blue tansy, helichrysum, and lavender calm the senses. Silky texture melts on contact without greasiness.',
                'price' => 46,
                'inventory' => 105,
                'image_url' => 'https://images.unsplash.com/photo-1522335789202-5295dce5cdab?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'name' => 'Dewveil Barrier Mist',
                'category' => 'skincare',
                'summary' => 'Ceramide + algae face mist for dewy, protected skin.',
                'description' => 'This micro-fine mist layers ceramides, snow mushroom, and chlorella to replenish moisture on the go. Ideal between skincare steps or post-flight.',
                'price' => 44,
                'inventory' => 120,
                'image_url' => 'https://images.unsplash.com/photo-1514996937319-344454492b37?q=80&w=1200&auto=format&fit=crop',
            ],

            // Pantry
            [
                'name' => 'Moonmilk Reishi Latte Blend',
                'category' => 'pantry',
                'summary' => 'Evening tonic of reishi, ashwagandha, and nutmeg to cue rest.',
                'description' => 'Stir this coconut milk powder with hot water for a velvety latte. Reishi nurtures the nervous system while nutmeg, vanilla, and cardamom create a dessert-like ritual.',
                'price' => 32,
                'inventory' => 150,
                'image_url' => 'https://images.unsplash.com/photo-1430165558479-de3cf8cf1478?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'name' => 'Dawn Chorus Ceremonial Cacao',
                'category' => 'pantry',
                'summary' => 'Stone-ground cacao discs with maca and rose for morning rituals.',
                'description' => 'Single-origin cacao from Guatemala blends with maca, rose petals, and coconut sugar. Melt into warm milk for a creamy, heart-opening tonic.',
                'price' => 48,
                'inventory' => 90,
                'image_url' => 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'name' => 'Riverstone Digestive Bitters',
                'category' => 'pantry',
                'summary' => 'Pre-meal bitters with gentian, fennel, and ginger to spark digestion.',
                'description' => 'Micro-dosed bitters crafted with gentian root, fennel seed, ginger, and lemon peel. Take 15 drops before meals to cue enzymatic activity.',
                'price' => 28,
                'inventory' => 130,
                'image_url' => 'https://images.unsplash.com/photo-1517686469429-8bdb88b9f907?q=80&w=1200&auto=format&fit=crop',
            ],

            // Bath
            [
                'name' => 'Forest Bath Mineral Soak',
                'category' => 'bath',
                'summary' => 'Hinoki + magnesium bath salts to ground your nervous system.',
                'description' => 'Hand-harvested magnesium flakes blend with hinoki, cypress, and vetiver essential oils to mimic a forest bath ritual. Each soak relieves muscles while the scent profile cues deep relaxation.',
                'price' => 44,
                'inventory' => 110,
                'image_url' => 'https://images.unsplash.com/photo-1501004318641-b39e6451bec6?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'name' => 'Tide Pool Seaweed Soak',
                'category' => 'bath',
                'summary' => 'Detox soak with Atlantic kelp, spirulina, and French clay.',
                'description' => 'Rehydrate skin with a mineral-rich blend of kelp, spirulina, and French clay. Eucalyptus and sage botanicals transform any tub into a tide pool session.',
                'price' => 52,
                'inventory' => 85,
                'image_url' => 'https://images.unsplash.com/photo-1503341455253-b2e723bb3dbb?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'name' => 'Cedar Steam Shower Cubes',
                'category' => 'bath',
                'summary' => 'Aromatherapy cubes releasing cedar + citrus in hot showers.',
                'description' => 'Place a cube on the shower floor and let steam activate cedar, grapefruit, and rosemary essential oils for spa-grade aromatherapy.',
                'price' => 29,
                'inventory' => 150,
                'image_url' => 'https://images.unsplash.com/photo-1503602642458-232111445657?q=80&w=1200&auto=format&fit=crop',
            ],

            // Tools
            [
                'name' => 'Solstice Copper Dry Brush',
                'category' => 'tools',
                'summary' => 'Ion-charged copper bristles encourage lymph flow pre-shower.',
                'description' => 'A sustainably harvested beechwood handle holds copper alloy bristles that spark microcirculation. Use with gentle strokes toward the heart for lymphatic drainage.',
                'price' => 42,
                'inventory' => 70,
                'image_url' => 'https://images.unsplash.com/photo-1512412046876-f943d424d4a3?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'name' => 'BloomStone Gua Sha Comb',
                'category' => 'tools',
                'summary' => 'Hand-carved stone comb for scalp lymph drainage.',
                'description' => 'Rose quartz carved with rounded teeth releases fascia tension along the scalp and neck. Includes a velvet carry pouch for travel rituals.',
                'price' => 40,
                'inventory' => 115,
                'image_url' => 'https://images.unsplash.com/photo-1595516116314-5f4b36bac24d?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'name' => 'Herbalist Brewing Beaker',
                'category' => 'tools',
                'summary' => 'Heat-proof borosilicate pitcher for decoctions + infusions.',
                'description' => 'Pour-over style brewer with etched measurements for steeping roots, flowers, and tonics. The bamboo lid keeps steam locked while you infuse.',
                'price' => 54,
                'inventory' => 90,
                'image_url' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?q=80&w=1200&auto=format&fit=crop',
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                array_merge($product, [
                    'slug' => Str::slug($product['name']),
                    'is_active' => true,
                ])
            );
        }
    }
}
