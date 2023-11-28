package websocket_server

import (
	"context"
	"encoding/json"
	"errors"
	"log"
	"net/http"
	"sort"
	"sync"

	"github.com/gorilla/websocket"
	"github.com/redis/go-redis/v9"
	logger "github.com/sirupsen/logrus"
	"irontec.com/realtime/pkg/config"
	"irontec.com/realtime/pkg/services"
	"irontec.com/realtime/pkg/utils"
)

var upgrader = websocket.Upgrader{
	ReadBufferSize:  1024,
	WriteBufferSize: 1024,
	CheckOrigin: func(r *http.Request) bool {
		return true // or more strict origin checking
	},
}

var redisPool sync.Map

func OnWorkerStart() {
	logger.Info("Init Redis Pool")

	http.HandleFunc("/", handler)
	listen := config.GetWsListenAddress()
	logger.Fatal(http.ListenAndServe(listen, nil))
}

func handler(w http.ResponseWriter, r *http.Request) {
	conn, err := upgrader.Upgrade(w, r, nil)

	if err != nil {
		log.Println(err)
		return
	}
	defer onClose(conn)

	logger.Info("Connection open")
	conn.WriteMessage(websocket.TextMessage, []byte("Challenge"))

	onMessage(conn)
}

func onClose(conn *websocket.Conn) {
	logger.Info("Connection closed")

	storedClient, ok := redisPool.Load(conn)
	if !ok {
		logger.Error("Could not find Redis client for the WebSocket connection.")
		return
	}

	client, ok := storedClient.(*redis.Client)
	if !ok {
		logger.Error("Unexpected type found in the map.")
		return
	}

	err := client.Close()
	if err != nil {
		logger.Errorf("Error closing Redis client: %v", err)
		return
	}
}

func onMessage(conn *websocket.Conn) {
	for {
		messageType, p, err := conn.ReadMessage()
		if err != nil {
			logger.Errorf("Error reading message: %s", err)
			return
		}

		if messageType == websocket.TextMessage {
			logger.Infof("<< Received message: %s", string(p))

			data := utils.GetPayload(string(p))
			token, err := utils.GetToken(data.Auth)

			if err != nil {
				logger.Errorf("Error reading token: %s", err)
				conn.WriteMessage(websocket.TextMessage, []byte("Challenge"))
				return
			}

			tokenPayload, err := utils.Decode(token)

			if err != nil {
				logger.Errorf("Error decoding token: %s", err)
				conn.WriteMessage(websocket.TextMessage, []byte("Challenge"))
				return
			}

			role := tokenPayload.Roles[0]
			registerChannel, err := services.GetActiveCallsFilter(data.Auth, role)

			if err != nil {
				conn.WriteMessage(websocket.TextMessage, []byte("Challenge"))
				return
			}

			sendCurrentStateAndUpdate(conn, *registerChannel)
		}
	}
}

func sendCurrentStateAndUpdate(conn *websocket.Conn, registerChannel string) {
	conn.WriteMessage(websocket.TextMessage, []byte("Subscribing"))

	go func(server *websocket.Conn, mask string) {
		redisClient, err := getRedisClientByConnection(server)

		if err != nil {
			logger.Error("Unable to create redis client")
			return
		}

		sendCurrentState(
			redisClient,
			mask,
			server,
		)

		forwardStateUpdates(
			redisClient,
			mask,
			server,
		)
	}(conn, registerChannel)
}

func sendCurrentState(redisClient *redis.Client, mask string, conn *websocket.Conn) {
	logger.Info("Sending current state (" + mask + ")")

	keys, err := redisClient.Keys(context.Background(), mask).Result()
	if err != nil {
		logger.Fatal(err)
	}

	currentState, err := redisClient.MGet(context.Background(), keys...).Result()
	if err != nil {
		logger.Error("No call info found on redis")
		return
	}

	var events []services.EventData
	for _, item := range currentState {

		itemStr, ok := item.(string)
		if !ok {
			logger.Warning("Unexpected type for item in itemStr")
			return
		}

		var event services.EventData
		err := json.Unmarshal([]byte(itemStr), &event)
		if err != nil {
			logger.Errorf("Error unmarshalling JSON data: %v", err)
			return
		}

		events = append(events, event)
	}

	sortByTimeCallable := func(a, b services.EventData) bool {
		var eventA, eventB services.EventData
		return eventA.Time < eventB.Time
	}

	sort.Slice(events, func(i, j int) bool {
		return sortByTimeCallable(events[i], events[j])
	})

	for _, item := range events {
		result, err := json.Marshal(item)
		if err != nil {
			logger.Errorf("Error marshalling struct to JSON: %v", err)
			return
		}
		conn.WriteMessage(websocket.TextMessage, result)
	}
}

func forwardStateUpdates(redisClient *redis.Client, mask string, conn *websocket.Conn) {
	pubsub := redisClient.PSubscribe(context.Background(), mask)

	go func() {
		for {
			msg, err := pubsub.Receive(context.Background())
			if subscription, ok := msg.(*redis.Subscription); ok {

				if subscription.Kind == "unsubscribe" {
					logger.Info("Unsubscribe")
					break
				}
			} else if message, ok := msg.(*redis.Message); ok {
				go func(conn *websocket.Conn, message *redis.Message) {
					payload := message.Payload
					var eventData services.EventData

					err := json.Unmarshal([]byte(payload), &eventData)
					if err != nil {
						logger.Errorf("Error: %v", err)
						return
					}

					forward := utils.InArray(eventData.Event, services.SIGNIFICANT_CALL_EVENTS[:])
					if !forward {
						logger.Errorf("Cannot forward message: %v", payload)
						return
					}
					conn.WriteMessage(websocket.TextMessage, []byte(payload))

				}(conn, message)
			}

			if err != nil {
				logger.Errorf("Error receiving message from Redis: %v", err)
				return
			}

		}
	}()
}

func getRedisClientByConnection(conn *websocket.Conn) (*redis.Client, error) {

	storedClient, ok := redisPool.Load(conn)
	if !ok {
		logger.Warning("Could not find Redis client for the WebSocket connection.")
		client := services.CreateFailOverClient()
		redisPool.Store(conn, client)
		return client, nil
	}

	client, ok := storedClient.(*redis.Client)
	if !ok {
		return nil, errors.New("unexpected type found in the map")
	}

	return client, nil
}
