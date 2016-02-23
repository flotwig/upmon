each server
    has 0 or more aspects
    has 1 state
    has 0 or more events
each aspect
    belongs to 1 server
    has 1 state
    has 1 type
    has 0 or more events
each event
    belongs to 1 server
    belongs to 1 aspect
each state
    belongs to many servers
    belongs to many aspects
each type
    belongs to many aspects