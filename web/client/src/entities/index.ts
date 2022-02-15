import BillableCall from './BillableCall/BillableCall';
import Calendar from './Calendar/Calendar';
import CallAcl from './CallAcl/CallAcl';
import CallCsvScheduler from './CallCsvScheduler/CallCsvScheduler';
import CallForwardSetting from './CallForwardSetting/CallForwardSetting';
import CompanyService from './CompanyService/CompanyService';
import ConditionalRoute from './ConditionalRoute/ConditionalRoute';
import ConditionalRoutesCondition from './ConditionalRoutesCondition/ConditionalRoutesCondition';
import ConditionalRoutesConditionsRelCalendar from './ConditionalRoutesConditionsRelCalendar/ConditionalRoutesConditionsRelCalendar';
import ConditionalRoutesConditionsRelMatchList from './ConditionalRoutesConditionsRelMatchList/ConditionalRoutesConditionsRelMatchList';
import ConditionalRoutesConditionsRelRouteLock from './ConditionalRoutesConditionsRelRouteLock/ConditionalRoutesConditionsRelRouteLock';
import ConditionalRoutesConditionsRelSchedule from './ConditionalRoutesConditionsRelSchedule/ConditionalRoutesConditionsRelSchedule';
import ConferenceRoom from './ConferenceRoom/ConferenceRoom';
import Country from './Country/Country';
import Ddi from './Ddi/Ddi';
import Extension from './Extension/Extension';
import ExternalCallFilter from './ExternalCallFilter/ExternalCallFilter';
import Fax from './Fax/Fax';
import Friend from './Friend/Friend';
import HuntGroup from './HuntGroup/HuntGroup';
import HuntGroupsRelUser from './HuntGroupsRelUser/HuntGroupsRelUser';
import Ivr from './Ivr/Ivr';
import IvrEntry from './IvrEntry/IvrEntry';
import Locution from './Locution/Locution';
import MatchList from './MatchList/MatchList';
import MusicOnHold from './MusicOnHold/MusicOnHold';
import OutgoingDdiRule from './OutgoingDdiRule/OutgoingDdiRule';
import PickUpGroup from './PickUpGroup/PickUpGroup';
import Queue from './Queue/Queue';
import QueueMember from './QueueMember/QueueMember';
import RatingProfile from './RatingProfile/RatingProfile';
import Recording from './Recording/Recording';
import ResidentialDevice from './ResidentialDevice/ResidentialDevice';
import RetailAccount from './RetailAccount/RetailAccount';
import RouteLock from './RouteLock/RouteLock';
import RoutingTag from './RoutingTag/RoutingTag';
import Schedule from './Schedule/Schedule';
import Service from './Service/Service';
import Terminal from './Terminal/Terminal';
import TerminalModel from './TerminalModel/TerminalModel';
import User from './User/User';
import UsersCdr from './UsersCdr/UsersCdr';
import { EntityList } from 'lib/router/parseRoutes';

const entities: EntityList = {
  BillableCall,
  Calendar,
  CallAcl,
  CallCsvScheduler,
  CallForwardSetting,
  CompanyService,
  ConditionalRoute,
  ConditionalRoutesCondition,
  ConditionalRoutesConditionsRelCalendar,
  ConditionalRoutesConditionsRelMatchList,
  ConditionalRoutesConditionsRelRouteLock,
  ConditionalRoutesConditionsRelSchedule,
  ConferenceRoom,
  Country,
  Ddi,
  Extension,
  ExternalCallFilter,
  Fax,
  Friend,
  HuntGroup,
  HuntGroupsRelUser,
  Ivr,
  IvrEntry,
  Locution,
  MatchList,
  MusicOnHold,
  OutgoingDdiRule,
  PickUpGroup,
  Queue,
  QueueMember,
  RatingProfile,
  Recording,
  ResidentialDevice,
  RetailAccount,
  RouteLock,
  RoutingTag,
  Schedule,
  Service,
  Terminal,
  TerminalModel,
  User,
  UsersCdr,
};

export default entities;