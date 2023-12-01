package log

import (
	"github.com/sirupsen/logrus"
	"irontec.com/realtime/pkg/config"
)

func InitLog() {
	logrus.SetLevel(
		config.GetLogLevel(),
	)
}
