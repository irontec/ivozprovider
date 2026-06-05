package log

import (
	"github.com/sirupsen/logrus"
	"irontec.com/click2call/pkg/config"
)

func InitLog() {
	logrus.SetLevel(
		config.GetLogLevel(),
	)
}
