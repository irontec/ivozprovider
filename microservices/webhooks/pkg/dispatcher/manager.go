package dispatcher

import (
	"context"
	"strconv"
	"sync"

	"github.com/redis/go-redis/v9"
	logger "github.com/sirupsen/logrus"
	"irontec.com/webhooks/pkg/config"
	"irontec.com/webhooks/pkg/db"
)

const reloadChannel = "WebhookReload"

type workerEntry struct {
	cancel context.CancelFunc
	wg     *sync.WaitGroup
	cache  map[string]EventData
}

func Start(ctx context.Context) {
	reloadCh := make(chan int, 8)
	go listenReloadSignals(ctx, reloadCh)

	webhooks, err := db.LoadWebhooks()
	if err != nil {
		logger.Fatalf("Failed to load webhooks from DB: %v", err)
	}
	logger.Infof("Loaded %d webhooks", len(webhooks))

	workers := make(map[int]workerEntry)
	for _, webhook := range webhooks {
		startWorker(ctx, workers, webhook, nil)
	}

	for {
		select {
		case <-ctx.Done():
			for _, entry := range workers {
				entry.cancel()
			}
			for id, entry := range workers {
				entry.wg.Wait()
				logger.Infof("[webhook:%d] stopped", id)
			}
			logger.Info("All workers stopped")
			return
		case webhookID := <-reloadCh:
			reloadWorker(ctx, workers, webhookID)
		}
	}
}

func startWorker(ctx context.Context, workers map[int]workerEntry, webhook db.Webhook, cache map[string]EventData) {
	if cache == nil {
		cache = make(map[string]EventData)
	}
	workerCtx, cancel := context.WithCancel(ctx)
	wg := &sync.WaitGroup{}
	wg.Add(1)
	workers[webhook.ID] = workerEntry{cancel: cancel, wg: wg, cache: cache}
	go RunWorker(workerCtx, wg, webhook, cache)
}

func stopWorker(workers map[int]workerEntry, id int) map[string]EventData {
	entry, ok := workers[id]
	if !ok {
		return nil
	}
	entry.cancel()
	entry.wg.Wait()
	delete(workers, id)
	return entry.cache
}

func reloadWorker(ctx context.Context, workers map[int]workerEntry, webhookID int) {
	cache := stopWorker(workers, webhookID)

	webhook, err := db.LoadWebhookByID(webhookID)
	if err != nil {
		logger.Errorf("[webhook:%d] failed to load from DB: %v", webhookID, err)
		return
	}
	if webhook == nil {
		logger.Infof("[webhook:%d] deleted, worker stopped", webhookID)
		return
	}
	logger.Infof("[webhook:%d] reloaded, starting new worker", webhookID)
	startWorker(ctx, workers, *webhook, cache)
}

func listenReloadSignals(ctx context.Context, reloadCh chan<- int) {
	client := redis.NewFailoverClient(&redis.FailoverOptions{
		SentinelAddrs: []string{config.GetRedisSentinelAddr()},
		MasterName:    config.GetRedisMaster(),
		DB:            config.GetRedisDatabase(),
	})
	defer client.Close()

	pubsub := client.Subscribe(ctx, reloadChannel)
	defer pubsub.Close()

	ch := pubsub.Channel()
	for {
		select {
		case <-ctx.Done():
			return
		case msg, ok := <-ch:
			if !ok {
				return
			}
			id, err := strconv.Atoi(msg.Payload)
			if err != nil {
				logger.Warnf("Invalid webhook ID in reload signal: %q", msg.Payload)
				continue
			}
			logger.Infof("Reload signal received for webhook ID: %d", id)
			select {
			case reloadCh <- id:
			default:
				logger.Warnf("[webhook:%d] reload already pending, signal discarded", id)
			}
		}
	}
}
