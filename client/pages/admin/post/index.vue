<template>
    <div>
        <Post/>
    </div>
</template>

<script>
    import Post from '~/components/Backend/Post/PostApp';
    
    export default {
        middleware: 'auth',
        components: {
            Post
        }
    }
</script>