import entities from "../entities";
import _ from 'lib/services/translations/translate';
import routeMapParser, { RouteMap } from "lib/router/routeMapParser";

const map: RouteMap = [
    {
        label: _('General'),
        children: [
            {
                entity: entities.User,
                children: [
                    {
                        entity: {
                            ...entities.HuntGroupsRelUser,
                            acl: {
                                read: true,
                                detail: false,
                                create: false,
                                update: false,
                                delete: true,
                            }
                        },
                        filterBy: 'user',
                    },
                    {
                        entity: entities.CallForwardSetting,
                        filterBy: 'user',
                    }
                ],
            },
            {
                entity: entities.Terminal,
            },
            {
                entity: entities.Extension,
            },
            {
                entity: entities.Ddi,
                children: [
                    {
                        entity: entities.BillableCall,
                        filterBy: 'ddi',
                    },
                ],
            },
            {
                entity: entities.Fax,
                children: [
                    {
                        entity: entities.FaxesInOut,
                        filterBy: 'fax',
                    },
                ],
            },
            {
                entity: entities.CompanyService,
            },
            {
                entity: {
                    ...entities.RatingProfile,
                    acl: {
                        ...entities.RatingProfile.acl,
                        detail: false,
                    },
                },
            },
        ]
    },
    {
        label: _('Routing endpoints'),
        children: [
            {
                entity: entities.Ivr,
                children: [
                    {
                        entity: entities.IvrEntry,
                        filterBy: 'ivr',
                    },
                ],
            },
            {
                entity: entities.HuntGroup,
                children: [
                    {
                        entity: {
                            ...entities.HuntGroupsRelUser,
                            columns: [
                                'routeType',
                                'target',
                                'timeoutTime',
                            ],
                        },
                        filterBy: 'huntGroup',
                    },
                ],
            },
            {
                entity: entities.Queue,
                children: [
                    {
                        entity: entities.QueueMember,
                        filterBy: 'queue',
                    }
                ],
            },
            {
                entity: entities.ConditionalRoute,
                children: [
                    {
                        entity: entities.ConditionalRoutesCondition,
                        filterBy: 'conditionalRoute'
                    }
                ]
            },
            {
                entity: entities.Invoice,
            },
            {
                entity: entities.Friend,
                children: [
                    {
                        entity: entities.FriendsPattern,
                        filterBy: 'friend',
                    },
                    {
                        entity: entities.CallForwardSetting,
                        filterBy: 'friend',
                    },
                ],
            },
            {
                entity: entities.ConferenceRoom,
            },
        ],
    },
    {
        label: _('Routing tools'),
        children: [
            {
                entity: entities.ExternalCallFilter,
            },
            {
                entity: entities.Calendar,
                children: [
                    {
                        entity: entities.HolidayDate,
                        filterBy: 'calendar',
                    },
                    {
                        entity: entities.CalendarPeriod,
                        filterBy: 'calendar',
                    },
                ],
            },
            {
                entity: entities.Schedule,
            },
            {
                entity: entities.MatchList,
                children: [
                    {
                        entity: entities.MatchListPattern,
                        filterBy: 'matchList',
                    }
                ]
            },
            {
                entity: entities.RouteLock,
            },
        ],
    },
    {
        label: _('User configuration'),
        children: [
            {
                entity: entities.OutgoingDdiRule,
                children: [
                    {
                        entity: entities.OutgoingDdiRulesPattern,
                        filterBy: 'outgoingDdiRule',
                    }
                ],
            },
            {
                entity: entities.PickUpGroup,
            },
            {
                entity: entities.CallAcl,
            },
            {
                entity: entities.Voicemail,
            },
        ],
    },
    {
        label: _('Multimedia'),
        children: [
            {
                entity: entities.Locution,
            },
            {
                entity: entities.MusicOnHold,
            },
        ],
    },
    {
        label: _('Calls'),
        children: [
            {
                entity: entities.UsersCdr,
            },
            {
                entity: entities.BillableCall,
            },
            {
                entity: entities.CallCsvScheduler,
                children: [
                    {
                        entity: entities.CallCsvReport,
                        filterBy: 'callCsvScheduler',
                    }
                ],
            },
            {
                entity: entities.Recording,
            },
        ],
    }
];

export default routeMapParser(map);