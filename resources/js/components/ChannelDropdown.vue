<template>
    <li class="nav-item dropdown" :class="{'open': toggle}">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @click.prevent="toggle = !toggle"> Channels<span class="caret"></span></a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <div class="input-wrapper">
                <input type="text" class="form-control" v-model="filter" placeholder="Filter Channels..."/>
            </div>
            <a class="dropdown-item" v-for="channel in filteredThreads" :href="`/threads/${channel.slug}`" v-text="channel.name"></a>
        </div>
    </li>
</template>

<style lang="scss">
    .channel-dropdown{
        padding:0;
    }

    .input-wrapper{
        padding:.5rem 1rem;
    }

    .channel-list{
        max-height: 400px; overflow:auto;
        margin-bottom:0;
        .list-group-item{
            border-radius:0;
            border-left: none;
            border-right: none;
        }
    }
</style>

<script>
    export default {
        props: ['channels'],

        data() {
            return {
                toggle:false,
                filter: ''
            }
        },

        computed: {
            filteredThreads() {
                return this.channels.filter(channel => {
                    return channel.name.toLowerCase().includes(this.filter.toLocaleLowerCase())
                })
            }
        }
    }
</script>
