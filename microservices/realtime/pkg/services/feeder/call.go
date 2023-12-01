package feeder

import (
	"errors"
	"time"
)

// Call is an abstract class representing a call.
type AbstractCall struct {
	ID      string
	callId  string
	status  string
	channel string
}

// Call statuses
const (
	CALL_SETUP  = "Trying"
	RINGING     = "Early"
	IN_CALL     = "Confirmed"
	HANG_UP     = "Terminated"
	UPDATE_CLID = "UpdateCLID"
)

// SignificantCallEvents is an array of significant call events.
var SignificantCallEvents = []string{CALL_SETUP, RINGING, IN_CALL, HANG_UP, UPDATE_CLID}

func (c *AbstractCall) IsDone() bool {
	return c.GetStatus() == HANG_UP
}

func (c *AbstractCall) GetCallId() string {
	return c.callId
}

func (c *AbstractCall) SetCallId(callId string) {
	c.callId = callId
}

func (c *AbstractCall) GetStatus() string {
	return c.status
}

func (c *AbstractCall) SetStatus(status string) {
	c.status = status
}

func (c *AbstractCall) GetChannel() string {
	return c.channel
}

func (c *AbstractCall) SetChannel(channel string) {
	c.channel = channel
}

// Progress applies progress to the call based on its status.
func (c *AbstractCall) Progress() (map[string]interface{}, error) {
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

func (c *AbstractCall) callSetup() map[string]interface{} {
	c.status = CALL_SETUP

	payload := map[string]interface{}{
		"Event":   c.status,
		"Time":    time.Now().Unix(),
		"Call-ID": c.callId,
		"ID":      c.ID,
		"channel": c.channel,
	}

	return payload
}

func (c *AbstractCall) ringing() map[string]interface{} {
	c.status = RINGING

	payload := map[string]interface{}{
		"Event":   c.status,
		"Time":    time.Now().Unix(),
		"Call-ID": c.callId,
		"ID":      c.ID,
	}

	return map[string]interface{}{
		c.channel: payload,
	}
}

func (c *AbstractCall) inCall() map[string]interface{} {
	c.status = IN_CALL

	payload := map[string]interface{}{
		"Event":   c.status,
		"Time":    time.Now().Unix(),
		"Call-ID": c.callId,
		"ID":      c.ID,
	}

	return map[string]interface{}{
		c.channel: payload,
	}
}

func (c *AbstractCall) hangUp() map[string]interface{} {
	c.status = HANG_UP

	payload := map[string]interface{}{
		"Event":   c.status,
		"Time":    time.Now().Unix(),
		"Call-ID": c.callId,
		"ID":      c.ID,
	}

	return map[string]interface{}{
		c.channel: payload,
	}
}
