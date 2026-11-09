package dispatcher

import (
	"bytes"
	"context"
	"encoding/json"
	"errors"
	"fmt"
	"net/http"
	"net/url"
	"regexp"
	"strings"
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
	Company     string `json:"Company"`
	Direction   string `json:"Direction"`
	Caller      string `json:"Caller,omitempty"`
	Callee      string `json:"Callee,omitempty"`
	Carrier     string `json:"Carrier,omitempty"`
	DdiProvider string `json:"DdiProvider,omitempty"`
	Owner       string `json:"Owner,omitempty"`
	Party       string `json:"Party,omitempty"`
	Iden        string `json:"Iden,omitempty"`
	DdiID       string `json:"-"`
	CrID        string `json:"-"`
	DpID        string `json:"-"`
}

type webhookConfig struct {
	BrandID   int
	CompanyID int
	DdiID     *int
	UserID    *int
}

func RunWorker(ctx context.Context, wg *sync.WaitGroup, webhook db.Webhook, cache map[string]EventData) {
	defer wg.Done()

	pattern := buildPatterns(webhook)
	logger.Infof("[webhook:%d] %s subscribing to %v", webhook.ID, webhook.Name, pattern)

	redisClient := redis.NewFailoverClient(&redis.FailoverOptions{
		SentinelAddrs: []string{config.GetRedisSentinelAddr()},
		MasterName:    config.GetRedisMaster(),
		DB:            config.GetRedisDatabase(),
	})
	defer redisClient.Close()

	pubsub := redisClient.PSubscribe(ctx, pattern)
	defer pubsub.Close()

	cfg := webhookConfig{
		BrandID:   webhook.BrandID,
		CompanyID: webhook.CompanyID,
		DdiID:     webhook.DdiID,
		UserID:    webhook.UserID,
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
			handleMessage(webhook, cfg, msg.Channel, msg.Payload, cache)
		}
	}
}

func buildPatterns(webhook db.Webhook) string {
	if webhook.UserID != nil {
		base := fmt.Sprintf("users:b*:c*:u%d", *webhook.UserID)
		switch webhook.CallDirection {
		case "inbound":
			return base + ":inbound:*"
		case "outbound":
			return base + ":outbound:*"
		default:
			return base + ":*"
		}
	}

	ddiSeg := "ddi*"
	if webhook.DdiID != nil {
		ddiSeg = fmt.Sprintf("ddi%d", *webhook.DdiID)
	}

	base := fmt.Sprintf("trunks:b%d:c%d:%s", webhook.BrandID, webhook.CompanyID, ddiSeg)

	switch webhook.CallDirection {
	case "inbound":
		return base + ":dp*"
	case "outbound":
		return base + ":cr*"
	default:
		return base + ":*"
	}
}

type channelParts struct {
	DdiID string
	CrID  string
	DpID  string
}

func parseChannel(channel string) channelParts {
	var parts channelParts
	for _, seg := range strings.Split(channel, ":") {
		switch {
		case strings.HasPrefix(seg, "ddi"):
			parts.DdiID = seg[3:]
		case strings.HasPrefix(seg, "cr"):
			parts.CrID = seg[2:]
		case strings.HasPrefix(seg, "dp"):
			parts.DpID = seg[2:]
		}
	}
	return parts
}

func mergeIntoCache(cache map[string]EventData, incoming EventData) EventData {
	cached, ok := cache[incoming.ID]
	if !ok {
		cache[incoming.ID] = incoming
		return incoming
	}

	cached.Event = incoming.Event
	cached.Time = incoming.Time
	if incoming.ID != "" {
		cached.ID = incoming.ID
	}
	if incoming.Company != "" {
		cached.Company = incoming.Company
	}
	if incoming.Direction != "" {
		cached.Direction = incoming.Direction
	}
	if incoming.Caller != "" {
		cached.Caller = incoming.Caller
	}
	if incoming.Callee != "" {
		cached.Callee = incoming.Callee
	}
	if incoming.Carrier != "" {
		cached.Carrier = incoming.Carrier
	}
	if incoming.DdiProvider != "" {
		cached.DdiProvider = incoming.DdiProvider
	}
	if incoming.Owner != "" {
		cached.Owner = incoming.Owner
	}
	if incoming.Party != "" {
		cached.Party = incoming.Party
	}
	if incoming.Iden != "" {
		cached.Iden = incoming.Iden
	}
	if incoming.DdiID != "" {
		cached.DdiID = incoming.DdiID
	}
	if incoming.CrID != "" {
		cached.CrID = incoming.CrID
	}
	if incoming.DpID != "" {
		cached.DpID = incoming.DpID
	}

	cache[incoming.ID] = cached
	return cached
}

func handleMessage(webhook db.Webhook, cfg webhookConfig, channel, payload string, cache map[string]EventData) {
	logger.Debugf("[webhook:%d] received payload: %s", webhook.ID, payload)
	var incoming EventData
	if err := json.Unmarshal([]byte(payload), &incoming); err != nil {
		logger.Errorf("[webhook:%d] failed to parse event: %v", webhook.ID, err)
		return
	}

	parts := parseChannel(channel)
	incoming.DdiID = parts.DdiID
	incoming.CrID = parts.CrID
	incoming.DpID = parts.DpID

	event := mergeIntoCache(cache, incoming)

	if event.Event == "Terminated" {
		delete(cache, event.ID)
	}

	logger.Debugf("[webhook:%d] merged event type: %q id: %q callId: %q", webhook.ID, event.Event, event.ID, event.CallID)
	if !shouldDispatch(webhook, event.Event) {
		logger.Debugf("[webhook:%d] event %q not dispatched (no matching filter)", webhook.ID, event.Event)
		return
	}

	body := renderTemplate(webhook.Template, event, cfg)
	go postHTTP(http.DefaultClient, webhook, body)
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
	case "UpdateCLID":
		return webhook.EventUpdateClid
	default:
		return false
	}
}

func postHTTP(client *http.Client, webhook db.Webhook, body string) {
	request := fmt.Sprintf("[webhook:%d] %s POST to %s", webhook.ID, webhook.Name, endpoint(webhook.URI))

	resp, err := client.Post(webhook.URI, "application/json", bytes.NewBufferString(body))
	if err != nil {
		logger.Errorf("%s failed: %s", request, cause(err))
		return
	}
	defer resp.Body.Close()

	if resp.StatusCode >= 400 {
		logger.Warnf("%s returned %d", request, resp.StatusCode)
	} else {
		logger.Debugf("%s -> %d", request, resp.StatusCode)
	}
}

// endpoint reduces a webhook URI to scheme and host, the only parts that are
// safe to log: path, query, fragment and userinfo often carry tokens.
func endpoint(uri string) string {
	u, err := url.Parse(uri)
	if err != nil || u.Host == "" {
		return "<invalid URI>"
	}
	return u.Scheme + "://" + u.Host
}

// quoted matches the %q-quoted values net/http and net/url copy from the
// request into their errors: a Location header, a malformed host or port.
var quoted = regexp.MustCompile(`"(?:[^"\\]|\\.)*"`)

// cause describes a failed POST without the request URL, which *url.Error
// prepends, nor any piece of a URI quoted inside the underlying error.
func cause(err error) string {
	var urlErr *url.Error
	if errors.As(err, &urlErr) {
		err = urlErr.Err
	}
	return quoted.ReplaceAllString(err.Error(), `"<redacted>"`)
}
