package main

import (
	"context"
	"os/signal"
	"syscall"

	logger "github.com/sirupsen/logrus"
	"irontec.com/webhooks/pkg/config"
	"irontec.com/webhooks/pkg/db"
	"irontec.com/webhooks/pkg/dispatcher"
	log "irontec.com/webhooks/pkg/log"
)

func main() {
	if err := config.InitConfig(); err != nil {
		logger.Fatalf("Failed to load config: %v", err)
	}

	log.InitLog()

	webhooks, err := db.LoadWebhooks()
	if err != nil {
		logger.Fatalf("Failed to load webhooks from DB: %v", err)
	}

	if len(webhooks) == 0 {
		logger.Info("No webhooks configured, exiting")
		return
	}

	logger.Infof("Loaded %d webhooks", len(webhooks))

	ctx, stop := signal.NotifyContext(context.Background(), syscall.SIGTERM, syscall.SIGINT)
	defer stop()

	dispatcher.Start(ctx, webhooks)
}
