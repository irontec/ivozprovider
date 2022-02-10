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
            },
            {
                entity: entities.Queue,
            },
            {
                entity: entities.ConditionalRoute,
            },
            {
                entity: entities.Friend,
            },
            {
                entity: entities.ConferenceRoom,
            },
            {
                entity: entities.Fax,
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
            },
            {
                entity: entities.Schedule,
            },
            {
                entity: entities.MatchList,
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
            },
            {
                entity: entities.PickUpGroup,
            },
            {
                entity: entities.CallAcl,
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
            },
            {
                entity: entities.Recording,
            },
        ],
    }
];

export default routeMapParser(map);