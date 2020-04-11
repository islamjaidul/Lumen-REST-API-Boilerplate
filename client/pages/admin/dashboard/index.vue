<template>
    <Dashboard/>
</template>

<script>
    import Dashboard from "~/components/Backend/Dashboard/DashboardApp";
    export default {
        middleware: 'auth',
        components: {
            Dashboard
        }
    }
</script>