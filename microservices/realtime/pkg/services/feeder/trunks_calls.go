package feeder

import (
	"errors"
	"fmt"
	"math/rand"
	"time"
)

// TrunksCall is a type that extends AbstractCall.
type TrunksCall struct {
	AbstractCall
	caller string
	callee string
}

// NewTrunksCall creates a new instance of TrunksCall with random values.
func NewTrunksCall() *TrunksCall {
	call := &TrunksCall{}
	call.ID = RandomAlphaNum(8)

	call.SetCallId(
		fmt.Sprintf(
			"%s-%s-%s-%s-%s",
			RandomAlphaNum(8),
			RandomAlphaNum(4),
			RandomAlphaNum(4),
			RandomAlphaNum(4),
			RandomAlphaNum(12),
		))

	call.SetCaller(
		"+3494" + RandomNumeric(10),
	)
	call.SetCallee(
		"+3464" + RandomNumeric(10),
	)

	return call
}

// Progress applies progress to the call based on its status.
func (c *TrunksCall) Progress() (map[string]interface{}, error) {
	switch c.GetStatus() {
	case "":
		return c.callSetup(), nil
	case CALL_SETUP:
		return c.ringing(), nil
	case RINGING:
		return c.inCall(), nil
	case IN_CALL:
		return c.hangUp(), nil
	default:
		return nil, errors.New("no progress to apply on status " + c.GetStatus())
	}
}

// callSetup applies progress to the call during the CallSetup phase.
func (tc *TrunksCall) callSetup() map[string]interface{} {
	tc.SetStatus(
		CALL_SETUP,
	)

	payload := map[string]interface{}{
		"Event":     tc.GetStatus(),
		"Time":      time.Now().Unix(),
		"ID":        tc.ID,
		"Call-ID":   tc.GetCallId(),
		"Caller":    tc.GetCaller(),
		"Callee":    tc.GetCallee(),
		"BrandId":   1,
		"Brand":     "brand1",
		"CompanyId": 1,
		"Company":   "company1",
	}

	outbound := rand.Intn(3) > 1
	if outbound {
		payload["Direction"] = "outbound"
		payload["CarrierId"] = 1
		payload["Carrier"] = "carrier1"

		tc.SetChannel(
			fmt.Sprintf(
				"trunks:b%d:c%d:cr%d:%s",
				payload["BrandId"].(int),
				payload["CompanyId"].(int),
				payload["CarrierId"].(int),
				payload["Call-ID"].(string),
			),
		)
	} else {
		payload["Direction"] = "inbound"
		payload["DdiProviderId"] = 1
		payload["DdiProvider"] = "DdiProvider1"

		tc.SetChannel(
			fmt.Sprintf(
				"trunks:b%d:c%d:dp%d:%s",
				payload["BrandId"].(int),
				payload["CompanyId"].(int),
				payload["DdiProviderId"].(int),
				payload["Call-ID"].(string),
			),
		)
	}

	payload["Channel"] = tc.GetChannel()
	delete(payload, "BrandId")
	delete(payload, "CompanyId")
	delete(payload, "CarrierId")
	delete(payload, "DdiProviderId")

	return map[string]interface{}{
		tc.GetChannel(): payload,
	}
}

func (tc *TrunksCall) GetCaller() string {
	return tc.caller
}

func (tc *TrunksCall) SetCaller(caller string) {
	tc.caller = caller
}

func (tc *TrunksCall) GetCallee() string {
	return tc.callee
}

func (tc *TrunksCall) SetCallee(callee string) {
	tc.callee = callee
}
