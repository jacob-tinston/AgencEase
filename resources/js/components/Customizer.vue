<template>
    <aside id="customizer" class="sidebar sidebar_customizer" :class="open ? 'open' : ''">
        <!-- Toggler -->
        <div class="toggler-wrapper">
            <div>
                <button @click="toggleCustomizer" id="toggle-customizer" class="toggler">
                    <span class="la la-gear animate-spin-slow"></span>
                </button>
            </div>
        </div>

        <!-- Theme Customizer -->
        <div class="flex items-center justify-between h-20 p-4">
            <div>
                <h2>Theme Customizer</h2>
                <p>Customize & Preview</p>
            </div>
            <button @click="toggleCustomizer" class="close text-2xl leading-none hover:text-primary la la-times"></button>
        </div>

        <hr>
        
        <div class="overflow-y-auto">
            <div class="flex items-center justify-between p-4">
                <h5>Dark Mode</h5>
                <label class="switch switch_outlined">
                    <input class="dark-mode-toggler" type="checkbox">
                    <span></span>
                </label>
            </div>

            <hr>

            <div class="flex items-center justify-between p-4">
                <div>
                    <h5>Branded Menu</h5>
                    <small>Menu will be set to primary color</small>
                </div>
                <label class="switch switch_outlined">
                    <input @click="toggleBrandedMenu" type="checkbox">
                    <span></span>
                </label>
            </div>

            <hr>

            <div class="p-4">
                <h5>Theme</h5>
                <div class="themes">
                    <button v-for="color, theme in themes" @click="toggleTheme(theme)" :class="activeTheme == theme ? 'active' : ''">
                        <span class="color" :class="'bg-[' + color + ']'"></span>
                        <span v-text="theme"></span>
                    </button>
                </div>
            </div>

            <hr>

            <div class="p-4">
                <div>
                    <h5>Background</h5>
                </div>
                <div class="themes">
                    <button v-for="color, gray in grays" @click="toggleGray(gray)" :class="activeGray == gray ? 'active' : ''">
                        <span class="color" :class="'bg-[' + color + ']'"></span>
                        <span v-text="gray"></span>
                    </button>
                </div>
            </div>

            <hr>

            <div class="p-4">
                <h5>Fonts</h5>
                <div class="themes fonts">
                    <button v-for="label, font in fonts" @click="toggleFont(font)" :class="activeFont == label ? 'active' : ''">
                        <h5 :class="'font-' + font.toLowerCase()" v-text="font"></h5>
                        <p v-text="label"></p>
                    </button>
                </div>
            </div>
        </div>
    </aside>
</template>

<script>
    export default {
        data() {
            return {
                root: document.documentElement,
                open: false,
                brandedMenu: false,

                themes: {
                    "Red": "#DC2626",
                    "Orange": "#EA580C",
                    "Amber": "#D97706",
                    "Yellow": "#CA8A04",
                    "Lime": "#65A30D",
                    "Emerald": "#059669",
                    "Teal": "#0D9488",
                    "Cyan": "#0891B2",
                    "Sky": "#0284C7",
                    "Blue": "#2563EB",
                    "Indigo": "#4F46E5",
                    "Violet": "#7C3AED",
                    "Purple": "#9333EA",
                    "Fuchsia": "#C026D3",
                    "Pink": "#DB2777",
                    "Rose": "#E11D48",
                },
                activeTheme: "Indigo",

                grays: {
                    "Pure": "#4B5563",
                    "Slate": "#475569",
                    "Zinc": "#52525B",
                    "Neutral": "#525252",
                    "Stone": "#57534E",
                },
                activeGray: "Slate",

                fonts: {
                    "Nunito": "Nunito Sans",
                    "Montserrat": "Montserrat",
                    "Raleway": "Raleway",
                    "Poppins": "Poppins",
                    "Oswald": "Oswald",
                    "Roboto": "Roboto Condensed",
                    "Inter": "Inter",
                    "Yantramanav": "Yantramanav",
                },
                activeFont: "Poppins",
            }
        },

        methods: {
            toggleCustomizer() {
                this.open = !this.open;
            },

            toggleBrandedMenu() {
                const menuBar = document.querySelector(".menu-bar");
                
                if (menuBar) {
                    (this.brandedMenu = !this.brandedMenu) ? menuBar.classList.add('menu_branded') : menuBar.classList.remove('menu_branded');
                }
            },

            toggleTheme(theme) {
                this.activeTheme = theme;

                this.root.classList.forEach((value) => {
                    if (value.startsWith("theme-")) this.root.classList.remove(value);
                });
                this.root.classList.add("theme-" + theme.toLowerCase());
            },

            toggleGray(gray) {
                this.activeGray = gray;

                this.root.classList.forEach((value) => {
                    if (value.startsWith("gray-")) this.root.classList.remove(value);
                });
                this.root.classList.add("gray-" + gray.toLowerCase());
            },

            toggleFont(font) {
                this.activeFont = font;

                this.root.classList.forEach((value) => {
                    if (value.startsWith("font-")) this.root.classList.remove(value);
                });
                this.root.classList.add("font-" + font.toLowerCase());
            },
        },
    }
</script>
