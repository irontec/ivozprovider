import { EntityAclType } from '@irontec/ivoz-ui';
import routeMapParser, {
  RouteMap,
  RouteMapItem,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AltRouteIcon from '@mui/icons-material/AltRoute';
import DialpadIcon from '@mui/icons-material/Dialpad';
import ManageAccountsIcon from '@mui/icons-material/ManageAccounts';
import PlayLessonIcon from '@mui/icons-material/PlayLesson';
import PlumbingIcon from '@mui/icons-material/Plumbing';
import WalletIcon from '@mui/icons-material/Wallet';

import entities from '../entities';
import { AboutMe, ClientFeatures } from '../store/clientSession/aboutMe';

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
      entity: entities.User,
      divider: true,
      isAccessible: (aboutMe) => aboutMe.vpbx,
      children: [
        {
          entity: entities.CallForwardSetting,
          filterBy: 'user',
        },
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
        ...Object.values(entities.User.customActions),
      ],
    },
    {
      entity: entities.ResidentialDevice,
      divider: true,
      isAccessible: (aboutMe) => aboutMe.residential,
      children: [
        {
          entity: entities.CallForwardSetting,
          filterBy: 'residentialDevice',
        },
      ],
    },
    {
      entity: entities.RetailAccount,
      divider: true,
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
      entity: entities.Voicemail,
      isAccessible: (aboutMe) => aboutMe.residential,
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
    {
      entity: entities.Fax,
      isAccessible: (aboutMe) => {
        return (
          aboutMe.residential && aboutMe.features.includes(ClientFeatures.faxes)
        );
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
      entity: entities.Terminal,
      isAccessible: (aboutMe) => aboutMe.vpbx,
    },
    {
      entity: entities.Extension,
      isAccessible: (aboutMe) => aboutMe.vpbx,
    },
    {
      entity: entities.Ddi,
      isAccessible: (aboutMe) => aboutMe.residential,
      divider: true,
      children: [
        {
          entity: entities.BillableCall,
          filterBy: 'ddi',
        },
        {
          entity: entities.Recording,
          filterBy: 'ddi',
        },
      ],
    },
    {
      entity: entities.Ddi,
      isAccessible: (aboutMe) => aboutMe.vpbx || aboutMe.retail,
      children: [
        {
          entity: entities.BillableCall,
          filterBy: 'ddi',
        },
        {
          entity: entities.Recording,
          filterBy: 'ddi',
        },
      ],
    },
    {
      entity: entities.MatchList,
      isAccessible: (aboutMe) => aboutMe.residential,
      children: [
        {
          entity: entities.MatchListPattern,
          filterBy: 'matchList',
        },
      ],
    },
    {
      entity: entities.ExternalCallFilter,
      isAccessible: (aboutMe) => aboutMe.residential,
    },
    {
      label: _('Routing endpoints'),
      icon: AltRouteIcon,
      isAccessible: (aboutMe) => !aboutMe.residential,
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
                columns: ['routeType', 'target', 'timeoutTime', 'priority'],
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
          entity: entities.Friend,
          aclOverride: () => {
            return {
              ...entities.Friend.acl,
              create: false,
              delete: false,
            };
          },
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
          isAccessible: (aboutMe) => aboutMe.vpbx,
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
        {
          entity: entities.Fax,
          isAccessible: (aboutMe) => {
            return (
              !aboutMe.residential &&
              aboutMe.features.includes(ClientFeatures.faxes)
            );
          },
          children: [
            {
              entity: entities.FaxesOut,
              filterBy: 'fax',
              filterValues: {
                'type[exact]': 'Out',
              },
              children: [...Object.values(entities.FaxesOut.customActions)],
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
      ],
    },
    {
      label: _('Routing tools'),
      icon: PlumbingIcon,
      isAccessible: (aboutMe) => !aboutMe.residential,
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
              entity: entities.HolidayDateRange,
              filterBy: 'calendar',
            },
            {
              entity: entities.HolidayDate,
              filterBy: 'calendar',
              children: [...Object.values(entities.HolidayDate.customActions)],
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
      icon: ManageAccountsIcon,
      isAccessible: (aboutMe) => !aboutMe.residential,
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
        {
          entity: entities.SurvivalDevice,
          isAccessible: (aboutMe) => aboutMe.vpbx,
        },
      ],
    },
    {
      label: _('Multimedia'),
      icon: PlayLessonIcon,
      isAccessible: (aboutMe) => !aboutMe.residential,
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
      entity: entities.CompanyService,
      divider: true,
      isAccessible: (aboutMe) => aboutMe.vpbx,
    },
    {
      entity: {
        ...entities.Contact,
        title: _('Address Book'),
      },
      isAccessible: (aboutMe) => aboutMe.vpbx,
    },
    {
      label: _('Billing'),
      icon: WalletIcon,
      children: [
        {
          entity: {
            ...entities.RatingProfile,
            acl: {
              ...entities.RatingProfile.acl,
              detail: false,
            },
          },
          isAccessible: (aboutMe) => aboutMe.billingInfo,
          children: [...Object.values(entities.RatingProfile.customActions)],
        },
        {
          entity: entities.Invoice,
          isAccessible: (aboutMe) => aboutMe.billingInfo,
        },
      ],
    },
    {
      label: _('Calls'),
      icon: DialpadIcon,
      children: [
        {
          entity: entities.UsersCdr,
          isAccessible: (aboutMe) => aboutMe.vpbx,
          children: [
            {
              entity: entities.Recording,
              filterBy: 'usersCdr',
            },
          ],
          ...Object.values(entities.UsersCdr.customActions),
        },
        {
          entity: entities.ActiveCalls,
        },
        {
          entity: entities.BillableCall,
          children: [...Object.values(entities.BillableCall.customActions)],
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
