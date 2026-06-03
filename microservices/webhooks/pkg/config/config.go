package config

import (
	"fmt"

	"github.com/sirupsen/logrus"
	"github.com/spf13/viper"
)

func InitConfig() error {
	viper.SetConfigName("config")
	viper.SetConfigType("yaml")
	viper.AddConfigPath("/opt/irontec/ivozprovider/microservices/webhooks/configs")

	return viper.ReadInConfig()
}

func GetDatabaseDSN() string {
	return viper.GetString("database.dsn")
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

func GetLogLevel() logrus.Level {
	level := logrus.ErrorLevel

	switch viper.GetInt("log.level") {
	case 0:
		level = logrus.PanicLevel
	case 1:
		level = logrus.FatalLevel
	case 2:
		level = logrus.ErrorLevel
	case 3:
		level = logrus.WarnLevel
	case 4:
		level = logrus.InfoLevel
	case 5:
		level = logrus.DebugLevel
	case 6:
		level = logrus.TraceLevel
	}

	return level
}
