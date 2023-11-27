package feeder

import (
	"fmt"
	"math/rand"
	"time"
)

type UsersCall struct {
	AbstractCall
	party int
}

func NewUsersCall() *UsersCall {
	u := &UsersCall{}
	u.ID = RandomAlphaNum(8)

	u.callId = fmt.Sprintf(
		"%s@192.168.0.%d",
		RandomAlphaNum(10),
		rand.Intn(255)+1,
	)

	u.party = rand.Intn(301) + 100

	return u
}

func (u *UsersCall) Progress() (map[string]interface{}, error) {
	switch u.status {
	case "":
		return u.callSetup(), nil
	case CALL_SETUP:
		return u.ringing(), nil
	case RINGING:
		return u.inCall(), nil
	case IN_CALL:
		return u.hangUp(), nil
	// case IN_CALL:
	// 	if rand.Intn(11) > 2 {
	// 		return u.AbstractCall.Progress()
	// 	}
	// 	return u.updateClid(), nil
	default:
		panic(fmt.Sprintf("No progress to apply on status %s", u.status))
	}
}

func (u *UsersCall) callSetup() map[string]interface{} {
	u.status = CALL_SETUP

	payload := map[string]interface{}{
		"Event":     u.status,
		"Time":      time.Now().Unix(),
		"ID":        u.ID,
		"Call-ID":   u.callId,
		"Party":     u.party,
		"BrandId":   1,
		"Brand":     "brand1",
		"CompanyId": 1,
		"Company":   "company1",
		"Direction": "outbound",
		"OwnerId":   "u1",
		"Owner":     "user1",
	}

	u.channel = fmt.Sprintf(
		"users:b%d:c%d:%s:%s",
		payload["BrandId"],
		payload["CompanyId"],
		payload["OwnerId"],
		payload["Call-ID"],
	)

	payload["Channel"] = u.GetChannel()

	delete(payload, "BrandId")
	delete(payload, "CompanyId")
	delete(payload, "OwnerId")

	return map[string]interface{}{
		u.channel: payload,
	}
}

func (u *UsersCall) updateClid() map[string]interface{} {
	u.status = HANG_UP

	payload := map[string]interface{}{
		"Event":   UPDATE_CLID,
		"Time":    time.Now().Unix(),
		"Call-ID": u.callId,
		"Party":   "+3464" + RandomNumeric(10),
	}

	return map[string]interface{}{
		u.channel: payload,
	}
}

func (uc *UsersCall) GetChannel() string {
	return uc.channel
}
