import entities from '../entities';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import routeMapParser, { RouteMap, RouteMapItem } from '@irontec/ivoz-ui/router/routeMapParser';
import { AboutMe } from 'store/clientSession/aboutMe';

type isAccessibleType = (aboutMe: AboutMe) => boolean;
export type ExtendedRouteMapItem = RouteMapItem & {
  isAccessible?: isAccessibleType,
};
export type ExtendedRouteMap = RouteMap<ExtendedRouteMapItem>;

const map: ExtendedRouteMap = [
  {
    label: _('General'),
    children: [
      {
        entity: entities.User,
        isAccessible: (aboutMe) => aboutMe.pbx,
        children: [
          {
            entity: {
              ...entities.HuntGroupsRelUser,
              acl: {
                iden: entities.HuntGroupsRelUser.acl.iden,
                read: true,
                detail: false,
                create: false,
                update: false,
                delete: true,
              },
            },
            filterBy: 'user',
          },
          {
            entity: entities.CallForwardSetting,
            filterBy: 'user',
          },
        ],
      },
      {
        entity: entities.Terminal,
        isAccessible: (aboutMe) => aboutMe.pbx,
      },
      {
        entity: entities.Extension,
        isAccessible: (aboutMe) => aboutMe.pbx,
      },
      {
        entity: entities.RetailAccount,
        isAccessible: (aboutMe) => aboutMe.retail,
        children: [
          {
            entity: entities.CallForwardSetting,
            filterBy: 'retailAccount',
          },
          {
            entity: entities.Ddi,
            filterBy: 'retailAccount',
          },
        ],
      },
      {
        entity: entities.Ddi,
        isAccessible: (aboutMe) => aboutMe.pbx || aboutMe.retail,
        children: [
          {
            entity: entities.BillableCall,
            filterBy: 'ddi',
          },
        ],
      },
      {
        entity: entities.Fax,
        isAccessible: (aboutMe) => aboutMe.features.includes('faxes'),
        children: [
          {
            entity: entities.FaxesInOut,
            filterBy: 'fax',
          },
        ],
      },
      {
        entity: entities.CompanyService,
        isAccessible: (aboutMe) => aboutMe.pbx,
      },
      {
        entity: {
          ...entities.RatingProfile,
          acl: {
            ...entities.RatingProfile.acl,
            detail: false,
          },
        },
        isAccessible: (aboutMe) => aboutMe.billingInfo,
      },
    ],
  },
  {
    label: _('Routing endpoints'),
    children: [
      {
        entity: entities.Ivr,
        isAccessible: (aboutMe) => aboutMe.pbx,
        children: [
          {
            entity: entities.IvrEntry,
            filterBy: 'ivr',
          },
        ],
      },
      {
        entity: entities.HuntGroup,
        isAccessible: (aboutMe) => aboutMe.pbx,
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
        isAccessible: (aboutMe) => aboutMe.pbx,
        children: [
          {
            entity: entities.QueueMember,
            filterBy: 'queue',
          },
        ],
      },
      {
        entity: entities.ConditionalRoute,
        isAccessible: (aboutMe) => aboutMe.pbx,
        children: [
          {
            entity: entities.ConditionalRoutesCondition,
            filterBy: 'conditionalRoute',
          },
        ],
      },
      {
        entity: entities.Invoice,
        isAccessible: (aboutMe) => aboutMe.billingInfo,
      },
      {
        entity: entities.Friend,
        isAccessible: (aboutMe) => aboutMe.pbx,
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
        isAccessible: (aboutMe) => aboutMe.pbx,
      },
    ],
  },
  {
    label: _('Routing tools'),
    children: [
      {
        entity: entities.ExternalCallFilter,
        isAccessible: (aboutMe) => aboutMe.pbx,
      },
      {
        entity: entities.Calendar,
        isAccessible: (aboutMe) => aboutMe.pbx,
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
        isAccessible: (aboutMe) => aboutMe.pbx,
      },
      {
        entity: entities.MatchList,
        isAccessible: (aboutMe) => aboutMe.pbx,
        children: [
          {
            entity: entities.MatchListPattern,
            filterBy: 'matchList',
          },
        ],
      },
      {
        entity: entities.RouteLock,
        isAccessible: (aboutMe) => aboutMe.pbx,
      },
    ],
  },
  {
    label: _('User configuration'),
    children: [
      {
        entity: entities.OutgoingDdiRule,
        isAccessible: (aboutMe) => aboutMe.pbx,
        children: [
          {
            entity: entities.OutgoingDdiRulesPattern,
            filterBy: 'outgoingDdiRule',
          },
        ],
      },
      {
        entity: entities.PickUpGroup,
        isAccessible: (aboutMe) => aboutMe.pbx,
      },
      {
        entity: entities.CallAcl,
        isAccessible: (aboutMe) => aboutMe.pbx,
      },
      {
        entity: entities.Voicemail,
        isAccessible: (aboutMe) => aboutMe.pbx || aboutMe.residential,
        children: [
          {
            entity: entities.VoicemailMessage,
            filterBy: 'voicemail',
          },
        ],
      },
      {
        entity: entities.Location,
        isAccessible: (aboutMe) => aboutMe.pbx,
      },
    ],
  },
  {
    label: _('Multimedia'),
    children: [
      {
        entity: entities.Locution,
        isAccessible: (aboutMe) => aboutMe.pbx,
      },
      {
        entity: entities.MusicOnHold,
        isAccessible: (aboutMe) => aboutMe.pbx,
      },
    ],
  },
  {
    label: _('Calls'),
    children: [
      {
        entity: entities.UsersCdr,
        isAccessible: (aboutMe) => aboutMe.pbx,
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
          },
        ],
      },
      {
        entity: entities.Recording,
        isAccessible: (aboutMe) => !aboutMe.wholesale,
      },
    ],
  },
];

export default routeMapParser<ExtendedRouteMapItem>(map);