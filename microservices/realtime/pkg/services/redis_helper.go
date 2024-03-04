package services

import (
	"context"
	"encoding/json"
	"time"

	"github.com/redis/go-redis/v9"
	logger "github.com/sirupsen/logrus"

	"irontec.com/realtime/pkg/config"
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

const REDIS_KEYS_TTL = 3 * time.Hour

// Constants
const (
	CALL_SETUP  = "Trying"
	RINGING     = "Early"
	IN_CALL     = "Confirmed"
	HANG_UP     = "Terminated"
	UPDATE_CLID = "UpdateCLID"
)

func InitRedisControlClients() {
	redisClient := CreateFailOverClient()

	logger.Info("Initializing generic channel subscriber")
	channelPatterns := []string{"trunks:*", "users:*"}
	pubsub := redisClient.PSubscribe(context.Background(), channelPatterns...)
	defer pubsub.Close()

	ch := pubsub.Channel()
	for {
		select {
		case msg := <-ch:
			updateCurrentCallsStatus(msg, redisClient)
		}
	}
}

func CreateFailOverClient() *redis.Client {
	return redis.NewFailoverClient(&redis.FailoverOptions{
		SentinelAddrs: []string{
			config.GetRedisSentinelAddr(),
		},
		MasterName: config.GetRedisMaster(),
		DB:         config.GetRedisDatabase(),
	})
}

func updateCurrentCallsStatus(msg *redis.Message, redisClient *redis.Client) {
	payload := msg.Payload
	channel := msg.Channel

	var eventData EventData
	err := json.Unmarshal([]byte(payload), &eventData)
	if err != nil {
		logger.Errorf("Error: %v", err)
		return
	}

	event := eventData.Event
	if event == HANG_UP {
		logger.Debug("[DEL] " + channel)
		redisClient.Del(context.Background(), channel)
		return
	}

	if event == CALL_SETUP {
		logger.Debug("[SETEX] " + channel + "\n" + payload)
		redisClient.SetEx(
			context.Background(),
			channel,
			payload,
			REDIS_KEYS_TTL,
		)
		return
	}

	dataStr, err := redisClient.Get(context.Background(), channel).Result()
	if err != nil {
		if err != redis.Nil {
			logger.Errorf("Error converting result to string: %v", err)
			return
		}
		return
	}

	var data EventData
	err = json.Unmarshal([]byte(dataStr), &data)
	if err != nil {
		logger.Errorf("Error: %v", err)
		return
	}

	var logInfo string
	if event == UPDATE_CLID {
		data.Party = eventData.Party
		logInfo = event + " => party " + data.Party
	} else {
		data.Event = event
		logInfo = event
	}

	logger.Debugf("[SETEX] %s", channel+" "+logInfo)

	// Convert again to string to store in redis
	dataBytes, err := json.Marshal(data)
	if err != nil {
		logger.Errorf("Failed to convert Event data to json: %s", data)
		return
	}

	redisClient.SetEx(
		context.Background(),
		channel,
		string(dataBytes),
		REDIS_KEYS_TTL,
	)

}
