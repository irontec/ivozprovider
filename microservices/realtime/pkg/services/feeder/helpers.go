package feeder

import (
	"context"
	"encoding/json"
	"errors"
	"fmt"

	"github.com/redis/go-redis/v9"
)

func ProgressTrunks(
	redisClient *redis.Client,
	trunkCall *TrunksCall,
) (*TrunksCall, error) {

	payload, err := trunkCall.Progress()
	if err != nil {
		return nil, errors.New("error reading payload")
	}

	for key, value := range payload {
		redisPush(redisClient, key, value.(map[string]interface{}), trunkCall)
	}

	return trunkCall, nil
}

func ProgressUsers(
	redisClient *redis.Client,
	userCall *UsersCall,
) (*UsersCall, error) {

	payload, err := userCall.Progress()
	if err != nil {
		return nil, errors.New("error reading payload")
	}

	for key, value := range payload {
		redisPush(redisClient, key, value.(map[string]interface{}), userCall)
	}

	return userCall, nil
}

func redisPush(
	redisClient *redis.Client,
	channel string,
	payload map[string]interface{},
	call interface{},
) {
	jsonPayload, err := json.Marshal(payload)
	if err != nil {
		fmt.Println("Error encoding payload:", err)
		return
	}

	err = redisClient.Publish(context.Background(), channel, string(jsonPayload)).Err()
	if err != nil {
		panic(err)
	}

	event := payload["Event"].(string)
	if event == CALL_SETUP {
		fmt.Printf("%s %s\n%s\n", event, channel, jsonPayload)
	} else {
		fmt.Printf("%s %s\n", event, channel)
	}

	fmt.Println()
}
