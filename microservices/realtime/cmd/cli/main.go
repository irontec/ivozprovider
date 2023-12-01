package main

import (
	"fmt"

	"irontec.com/realtime/pkg/config"
	"irontec.com/realtime/pkg/services/feeder"
)

func main() {
	loadConfig()
	feeder.Execute()
}

func loadConfig() {
	err := config.InitConfig()
	if err != nil {
		panic(fmt.Errorf("failed to read config file: %w", err))
	}
}
