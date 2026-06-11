package main

import (
	"fmt"

	"irontec.com/click2call/pkg/config"
	"irontec.com/click2call/pkg/log"
	"irontec.com/click2call/pkg/server"
)

func main() {
	if err := config.InitConfig(); err != nil {
		panic(fmt.Errorf("failed to read config file: %w", err))
	}

	log.InitLog()

	if err := server.Run(); err != nil {
		panic(err)
	}
}
