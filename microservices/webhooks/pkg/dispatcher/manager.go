package dispatcher

import (
	"context"
	"sync"

	logger "github.com/sirupsen/logrus"
	"irontec.com/webhooks/pkg/db"
)

func Start(ctx context.Context, webhooks []db.Webhook) {
	var wg sync.WaitGroup

	logger.Infof("Starting %d webhook workers", len(webhooks))

	for _, webhook := range webhooks {
		wg.Add(1)
		go RunWorker(ctx, &wg, webhook)
	}

	<-ctx.Done()
	logger.Info("Shutdown signal received, waiting for workers to stop")
	wg.Wait()
	logger.Info("All workers stopped")
}
