package config

import (
	"fmt"

	"github.com/spf13/viper"
)

func InitConfig() error {
	viper.SetConfigName("config")
	viper.SetConfigType("yaml")
	viper.AddConfigPath("/opt/irontec/ivozprovider/microservices/realtime/configs")

	return viper.ReadInConfig()
}

func GetWsListenAddress() string {
	return viper.GetString("ws.listen")
}

func GetJWTCertificate() string {
	return viper.GetString("ws.jwt_public")
}

func GetJWTPrivateKey() string {
	return viper.GetString("ws.jwt_private")
}

func GetHttpApiBrand() string {
	return viper.GetString("http.api.brand")
}

func GetHttpApiClient() string {
	return viper.GetString("http.api.client")
}

func GetHttpApiPlatform() string {
	return viper.GetString("http.api.platform")
}

func GetRedisSentinelAddr() string {
	return fmt.Sprintf(
		"%s:%d",
		viper.GetString("redis.sentinel_host"),
		viper.GetInt("redis.sentinel_port"),
	)
}

func GetRedisMaster() string {
	return viper.GetString("redis.master")
}

func GetRedisDatabase() int {
	return viper.GetInt("redis.db")
}
