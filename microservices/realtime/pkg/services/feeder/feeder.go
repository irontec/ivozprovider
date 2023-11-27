package feeder

import (
	"fmt"
	"math/rand"
	"sync"
	"time"

	"github.com/redis/go-redis/v9"
	"irontec.com/realtime/pkg/config"
)

var trunksCalls map[string]*TrunksCall = make(map[string]*TrunksCall)
var usersCalls map[string]*UsersCall = make(map[string]*UsersCall)
var redisClient = redis.NewClient(&redis.Options{
	Addr: "127.0.0.1:6379",
	DB:   config.GetRedisDatabase(),
})
var wg sync.WaitGroup

func Execute() {

	trunksCo(trunksCalls, usersCalls)
}

func trunksCo(
	trunksCalls map[string]*TrunksCall,
	usersCalls map[string]*UsersCall,
) {

	for {
		fmt.Printf("Current call number: %d\n\n", len(trunksCalls)+len(usersCalls))

		time.Sleep(5 * time.Second)

		trunksCall := NewTrunksCall()
		progressTrunks(trunksCalls, trunksCall)

		fmt.Println()

		usersCall := NewUsersCall()
		progressUsers(usersCalls, usersCall)

	}

}

func progressTrunks(calls map[string]*TrunksCall, trunkCall *TrunksCall) {

	if len(calls) == 0 {

		newCall, err := ProgressTrunks(redisClient, trunkCall)

		if err != nil {
			fmt.Println("failed to progress call")
		}

		trunksCalls[newCall.GetChannel()] = newCall
		return
	}

	currentCallNum := len(calls)
	increase := currentCallNum < 5 && rand.Intn(3) > 1 || rand.Intn(5) > 4

	if increase {
		newCall, err := ProgressTrunks(redisClient, trunkCall)

		if err != nil {
			fmt.Println("failed to progress call")
		}

		trunksCalls[newCall.GetChannel()] = newCall
		return

	}

	randomCallKey := ""
	for key := range calls {
		randomCallKey = key
		break
	}

	call := calls[randomCallKey]
	call, err := ProgressTrunks(redisClient, call)

	if err != nil {
		fmt.Println("failed to progress call")
	}

	if call.IsDone() {
		delete(calls, randomCallKey)
	}

}

func progressUsers(calls map[string]*UsersCall, userCall *UsersCall) {

	if len(calls) == 0 {

		newCall, err := ProgressUsers(redisClient, userCall)

		if err != nil {
			fmt.Println("failed to progress call")
		}

		usersCalls[newCall.GetChannel()] = newCall
		return
	}

	currentCallNum := len(calls)
	increase := currentCallNum < 5 && rand.Intn(3) > 1 || rand.Intn(5) > 4

	if increase {

		newCall, err := ProgressUsers(redisClient, userCall)

		if err != nil {
			fmt.Println("failed to progress call")
		}

		usersCalls[newCall.GetChannel()] = newCall
		return
	}

	randomCallKey := ""
	for key := range calls {
		randomCallKey = key
		break
	}

	call := calls[randomCallKey]
	call, err := ProgressUsers(redisClient, call)

	if err != nil {
		fmt.Println("failed to progress call")
	}

	if call.IsDone() {
		delete(calls, randomCallKey)
	}

}
