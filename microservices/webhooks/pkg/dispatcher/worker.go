package dispatcher

import (
	"bytes"
	"context"
	"encoding/json"
	"fmt"
	"net/http"
	"sync"

	"github.com/redis/go-redis/v9"
	logger "github.com/sirupsen/logrus"
	"irontec.com/webhooks/pkg/config"
	"irontec.com/webhooks/pkg/db"
)

type EventData struct {
	Event       string `json:"Event"`
	Time        int64  `json:"Time"`
	ID          string `json:"ID"`
	CallID      string `json:"Call-ID"`
	Brand       string `json:"Brand"`
	Company     string `json:"Company"`
	Direction   string `json:"Direction"`
	Party       string `json:"Party,omitempty"`
	Owner       string `json:"Owner,omitempty"`
	Caller      string `json:"Caller,omitempty"`
	Callee      string `json:"Callee,omitempty"`
	Carrier     string `json:"Carrier,omitempty"`
	DdiProvider string `json:"DdiProvider,omitempty"`
}

type webhookConfig struct {
	BrandID   int
	CompanyID int
	DdiID     *int
}

func RunWorker(ctx context.Context, wg *sync.WaitGroup, webhook db.Webhook) {
	defer wg.Done()

	patterns := buildPatterns(webhook)
	logger.Infof("[webhook:%d] %s subscribing to %v", webhook.ID, webhook.Name, patterns)

	redisClient := redis.NewFailoverClient(&redis.FailoverOptions{
		SentinelAddrs: []string{config.GetRedisSentinelAddr()},
		MasterName:    config.GetRedisMaster(),
		DB:            config.GetRedisDatabase(),
	})
	defer redisClient.Close()

	pubsub := redisClient.PSubscribe(ctx, patterns...)
	defer pubsub.Close()

	cfg := webhookConfig{
		BrandID:   webhook.BrandID,
		CompanyID: webhook.CompanyID,
		DdiID:     webhook.DdiID,
	}

	ch := pubsub.Channel()
	for {
		select {
		case <-ctx.Done():
			logger.Infof("[webhook:%d] shutting down", webhook.ID)
			return
		case msg, ok := <-ch:
			if !ok {
				logger.Warnf("[webhook:%d] redis channel closed", webhook.ID)
				return
			}
			handleMessage(webhook, cfg, msg.Payload)
		}
	}
}

func buildPatterns(webhook db.Webhook) string {
	if webhook.DdiID != nil {
		prefix := fmt.Sprintf(":b%d:c%d:ddi%d:", webhook.BrandID, webhook.CompanyID, *webhook.DdiID)
		return "trunks" + prefix + "*"
	}
	prefix := fmt.Sprintf(":b%d:c%d:", webhook.BrandID, webhook.CompanyID)
	return "trunks" + prefix + "*"
}

func handleMessage(webhook db.Webhook, cfg webhookConfig, payload string) {
	var event EventData
	if err := json.Unmarshal([]byte(payload), &event); err != nil {
		logger.Errorf("[webhook:%d] failed to parse event: %v", webhook.ID, err)
		return
	}

	if !shouldDispatch(webhook, event.Event) {
		return
	}

	body := renderTemplate(webhook.Template, event, cfg)
	go postHTTP(webhook.ID, webhook.URI, body)
}

func shouldDispatch(webhook db.Webhook, event string) bool {
	switch event {
	case "Trying":
		return webhook.EventStart
	case "Early":
		return webhook.EventRing
	case "Confirmed":
		return webhook.EventAnswer
	case "Terminated":
		return webhook.EventEnd
	default:
		return false
	}
}

func postHTTP(webhookID int, uri, body string) {
	resp, err := http.Post(uri, "application/json", bytes.NewBufferString(body))
	if err != nil {
		logger.Errorf("[webhook:%d] POST to %s failed: %v", webhookID, uri, err)
		return
	}
	defer resp.Body.Close()

	if resp.StatusCode >= 400 {
		logger.Warnf("[webhook:%d] POST to %s returned %d", webhookID, uri, resp.StatusCode)
	} else {
		logger.Debugf("[webhook:%d] POST to %s -> %d", webhookID, uri, resp.StatusCode)
	}
}
