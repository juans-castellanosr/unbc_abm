module.exports = {
    apps: [{
        name: "soketi",
        script: "soketi-pm2",
        instances: 1,
        exec_mode: "fork",
        args: "start",
        autorestart: true,
        max_restarts: 0,
        max_memory_restart: "1G",
        node_args: "--max-old-space-size=1024 --no-warnings",
        env: {
            NODE_ENV: "production",
            SOKETI_DEBUG: "true",
            SOKETI_MAX_CLIENTS: 250,
            SOKETI_METRICS_ENABLED: "true",
            SOKETI_PORT: 6001,
            SOKETI_METRICS_PORT: 9601,
            SOKETI_HOST: "127.0.0.1",
            SOKETI_PROTOCOL: "http",
            SOKETI_SUBSCRIBERS_PER_CHANNEL: 1000,
            SOKETI_PRESENCE_MAX_MEMBERS: 100,
            SOKETI_GRACEFUL_SHUTDOWN: "false"
        },
        error_file: "logs/soketi-error.log",
        out_file: "logs/soketi-out.log",
        merge_logs: true,
        kill_timeout: 60000,
        restart_delay: 10000
    }]
}
