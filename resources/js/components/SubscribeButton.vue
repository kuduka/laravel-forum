<template>
    <button :class="classes" @click="subscribe">Subscribe</button>
</template>

<script>
    export default {
        props: ['active'],
        data() {
            return {
                activelocal: this.active,
            }
        },
        computed: {
            classes() {
                return ['btn', this.activelocal ? 'btn-danger' : 'btn-primary'];
            }
        },
        methods: {
            subscribe() {
                axios[
                    (this.activelocal ? 'delete' : 'post')
                ](location.pathname + '/subscriptions');
                this.activelocal = ! this.activelocal;
            }
        }
    }
</script>