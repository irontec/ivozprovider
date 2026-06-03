package main

import (
	"context"
	"os/signal"
	"syscall"

	logger "github.com/sirupsen/logrus"
	"irontec.com/webhooks/pkg/config"
	"irontec.com/webhooks/pkg/dispatcher"
	log "irontec.com/webhooks/pkg/log"
)

func main() {
	if err := config.InitConfig(); err != nil {
		logger.Fatalf("Failed to load config: %v", err)
	}

	log.InitLog()

	ctx, stop := signal.NotifyContext(context.Background(), syscall.SIGTERM, syscall.SIGINT)
	defer stop()

	dispatcher.Start(ctx)
}
