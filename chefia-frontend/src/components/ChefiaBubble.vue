<template>
    <v-card class="mr-auto my-3 tri-right left-top" v-if="type === 'text'">
        <v-card-text>
            <div class="text--primary">
                {{ text }}
            </div>
        </v-card-text>
        <v-card-actions v-if="actionsAvailable && options.length !== 0" class="horiz-scroll">
            <v-btn color="indigo" dark v-for="(option, index) in options" v-bind:key="index" v-on:click="userSpeechHandler(option.alternativeText); getNextChatHandler(option.nextStateId); getItemsHandler(option.menuCategoriesId); actionsAvailable = false;" class="horiz-scroll-item">{{ option.alternativeText }}</v-btn>
        </v-card-actions>
    </v-card>
    <v-card class="mr-auto my-3" v-else-if="type === 'menu'">
        <v-card-text class="horiz-scroll">
            <v-card min-height="100%" min-width="250" max-width="250" class="horiz-scroll-item mr-3" v-for="item in items" v-bind:key="item.menuItemId">
                <v-card-text>
                    <p class="display-1 text--primary">
                        {{ item.menuItemName }}
                    </p>
                    <p class="subtitle-2 green--text">
                        R$ {{ item.menuItemPrice }}
                    </p>
                    <v-divider></v-divider>
                    <div class="text--primary mt-3">
                        {{ item.menuItemDescription }}
                    </div>
                </v-card-text>
                <v-card-actions class="mt-auto">
                    <v-btn text color="indigo" class="mx-auto" v-on:click.stop="currentItem = item; showDishDialog = true">
                        DAR UMA OLHADA!
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-card-text>
        <DishDialog v-model="showDishDialog" v-bind:item="currentItem" />
    </v-card>
</template>

<script>
import DishDialog from './DishDialog';

export default {
    name: 'ChefiaBubble',
    data: function () {
        return {
            actionsAvailable: true,
            showDishDialog: false,
            currentItem: {}
        }
    },
    components: {
        DishDialog
    },
    props: {
        type: String,
        text: String,
        options: Array,
        items: Array,
        getNextChatHandler: Function,
        getItemsHandler: Function,
        getItemHandler: Function,
        userSpeechHandler: Function
    }
}
</script>

<style scoped>
    .horiz-scroll {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;     
    }

    .horiz-scroll-item {
        display: flex;
        flex-direction: column;
    }

    .v-card-dish {
        min-height: 100%;
        min-width: 300;
        max-width: 300;
    }
</style>