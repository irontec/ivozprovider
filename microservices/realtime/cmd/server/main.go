package main

import (
	"fmt"

	"irontec.com/realtime/pkg/config"
	"irontec.com/realtime/pkg/services"
	"irontec.com/realtime/pkg/utils"
	websocket_server "irontec.com/realtime/pkg/websocket"
)

func main() {
	loadConfig()
	go services.InitRedisControlClients()
	websocket_server.OnWorkerStart()
}

func loadConfig() {
	err := config.InitConfig()
	if err != nil {
		panic(fmt.Errorf("failed to read config file: %w", err))
	}

	err = utils.LoadJWTCryptoData()
	if err != nil {
		panic(fmt.Errorf("failed to load JWT certificate: %w", err))
	}
}
