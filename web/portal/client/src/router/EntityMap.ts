import entities from '../entities';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import routeMapParser, {
  RouteMap,
  RouteMapItem,
} from '@irontec/ivoz-ui/router/routeMapParser';
import { AboutMe, ClientFeatures } from 'store/clientSession/aboutMe';
import { EntityAclType } from '@irontec/ivoz-ui';

type isAccessibleType = (aboutMe: AboutMe) => boolean;
type aclOverrideType = (aboutMe: AboutMe) => EntityAclType;
export type ExtendedRouteMapItem = RouteMapItem & {
  isAccessible?: isAccessibleType;
  aclOverride?: aclOverrideType;
};
export type ExtendedRouteMap = RouteMap<ExtendedRouteMapItem>;

const getEntityMap = (): ExtendedRouteMap => {
  const map: ExtendedRouteMap = [
    {
      label: _('General'),
      children: [
        {
          entity: entities.User,
          isAccessible: (aboutMe) => aboutMe.vpbx,
          children: [
            {
              entity: {
                ...entities.HuntGroupMember,
                acl: {
                  iden: entities.HuntGroupMember.acl.iden,
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
          entity: entities.ResidentialDevice,
          isAccessible: (aboutMe) => aboutMe.residential,
          children: [
            {
              entity: entities.CallForwardSetting,
              filterBy: 'residentialDevice',
            },
          ],
        },
        {
          entity: entities.Terminal,
          isAccessible: (aboutMe) => aboutMe.vpbx,
        },
        {
          entity: entities.Extension,
          isAccessible: (aboutMe) => aboutMe.vpbx,
        },
        {
          entity: entities.RetailAccount,
          isAccessible: (aboutMe) => aboutMe.retail,
          children: [
            {
              entity: entities.CallForwardSetting,
              filterBy: 'retailAccount',
              fixedValues: {
                callTypeFilter: 'both',
              },
            },
            {
              entity: entities.Ddi,
              filterBy: 'retailAccount',
            },
          ],
        },
        {
          entity: entities.Ddi,
          isAccessible: (aboutMe) =>
            aboutMe.vpbx || aboutMe.retail || aboutMe.residential,
          children: [
            {
              entity: entities.BillableCall,
              filterBy: 'ddi',
            },
          ],
        },
        {
          entity: entities.Fax,
          isAccessible: (aboutMe) => {
            return aboutMe.features.includes(ClientFeatures.faxes);
          },
          children: [
            {
              entity: entities.FaxesOut,
              filterBy: 'fax',
              filterValues: {
                'type[exact]': 'Out',
              },
            },
            {
              entity: entities.FaxesIn,
              filterBy: 'fax',
              filterValues: {
                'type[exact]': 'In',
              },
            },
          ],
        },
        {
          entity: entities.CompanyService,
          isAccessible: (aboutMe) => aboutMe.vpbx,
        },
        {
          entity: entities.Contact,
          isAccessible: (aboutMe) => aboutMe.vpbx,
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
          isAccessible: (aboutMe) => aboutMe.vpbx,
          children: [
            {
              entity: entities.IvrEntry,
              filterBy: 'ivr',
            },
          ],
        },
        {
          entity: entities.HuntGroup,
          isAccessible: (aboutMe) => aboutMe.vpbx,
          children: [
            {
              entity: {
                ...entities.HuntGroupMember,
                columns: ['routeType', 'target', 'timeoutTime'],
              },
              filterBy: 'huntGroup',
            },
          ],
        },
        {
          entity: entities.Queue,
          isAccessible: (aboutMe) =>
            aboutMe.vpbx && aboutMe.features.includes(ClientFeatures.queues),
          children: [
            {
              entity: entities.QueueMember,
              filterBy: 'queue',
            },
          ],
        },
        {
          entity: entities.ConditionalRoute,
          isAccessible: (aboutMe) => aboutMe.vpbx,
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
          isAccessible: (aboutMe) =>
            aboutMe.vpbx && aboutMe.features.includes(ClientFeatures.friends),
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
          isAccessible: (aboutMe) =>
            aboutMe.vpbx &&
            aboutMe.features.includes(ClientFeatures.conferences),
        },
        {
          entity: entities.Voicemail,
          isAccessible: (aboutMe) => aboutMe.vpbx || aboutMe.residential,
          aclOverride: (aboutMe) => {
            return {
              iden: entities.Voicemail.acl.iden,
              read: true,
              detail: false,
              create: aboutMe.vpbx,
              update: true,
              delete: aboutMe.vpbx,
            };
          },
          children: [
            {
              entity: entities.VoicemailMessage,
              filterBy: 'voicemail',
            },
          ],
        },
      ],
    },
    {
      label: _('Routing tools'),
      children: [
        {
          entity: entities.ExternalCallFilter,
          isAccessible: (aboutMe) => aboutMe.vpbx || aboutMe.residential,
        },
        {
          entity: entities.Calendar,
          isAccessible: (aboutMe) => aboutMe.vpbx,
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
          isAccessible: (aboutMe) => aboutMe.vpbx,
        },
        {
          entity: entities.MatchList,
          isAccessible: (aboutMe) => aboutMe.vpbx || aboutMe.residential,
          children: [
            {
              entity: entities.MatchListPattern,
              filterBy: 'matchList',
            },
          ],
        },
        {
          entity: entities.RouteLock,
          isAccessible: (aboutMe) => aboutMe.vpbx,
        },
      ],
    },
    {
      label: _('User configuration'),
      children: [
        {
          entity: entities.OutgoingDdiRule,
          isAccessible: (aboutMe) => aboutMe.vpbx,
          children: [
            {
              entity: entities.OutgoingDdiRulesPattern,
              filterBy: 'outgoingDdiRule',
            },
          ],
        },
        {
          entity: entities.PickUpGroup,
          isAccessible: (aboutMe) => aboutMe.vpbx,
        },
        {
          entity: entities.CallAcl,
          isAccessible: (aboutMe) => aboutMe.vpbx,
          children: [
            {
              entity: entities.CallAclRelMatchList,
              filterBy: 'callAcl',
            },
          ],
        },
        {
          entity: entities.Location,
          isAccessible: (aboutMe) => aboutMe.vpbx,
        },
      ],
    },
    {
      label: _('Multimedia'),
      children: [
        {
          entity: entities.Locution,
          isAccessible: (aboutMe) => aboutMe.vpbx,
        },
        {
          entity: entities.MusicOnHold,
          isAccessible: (aboutMe) => aboutMe.vpbx,
        },
      ],
    },
    {
      label: _('Calls'),
      children: [
        {
          entity: entities.UsersCdr,
          isAccessible: (aboutMe) => aboutMe.vpbx,
        },
        {
          entity: entities.ActiveCalls,
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
          isAccessible: (aboutMe) =>
            !aboutMe.wholesale &&
            aboutMe.features.includes(ClientFeatures.recordings),
        },
      ],
    },
  ];

  return routeMapParser<ExtendedRouteMapItem>(map);
};

export default getEntityMap;
