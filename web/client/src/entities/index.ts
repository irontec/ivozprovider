import BillableCall from './BillableCall/BillableCall';
import Calendar from './Calendar/Calendar';
import callAcl from './CallAcl/CallAcl';
import callCsvScheduler from './CallCsvScheduler/CallCsvScheduler';
import CompanyService from './CompanyService/CompanyService';
import conditionalRoute from './ConditionalRoute/ConditionalRoute';
import ConferenceRoom from './ConferenceRoom/ConferenceRoom';
import Country from './Country/Country';
import Ddi from './Ddi/Ddi';
import EntityInterface from 'entities/EntityInterface';
import Extension from './Extension/Extension';
import ExternalCallFilter from './ExternalCallFilter/ExternalCallFilter';
import Fax from './Fax/Fax';
import Friend from './Friend/Friend';
import HuntGroup from './HuntGroup/HuntGroup';
import Ivr from './Ivr/Ivr';
import Locution from './Locution/Locution';
import MatchList from './MatchList/MatchList';
import MusicOnHold from './MusicOnHold/MusicOnHold';
import OutgoingDdiRule from './OutgoingDdiRule/OutgoingDdiRule';
import PickUpGroup from './PickUpGroup/PickUpGroup';
import Queue from './Queue/Queue';
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


interface EntityList {
  [name: string]: Readonly<EntityInterface>
}

const entities: Readonly<EntityList> = {
  BillableCall,
  Calendar,
  CallAcl: callAcl,
  CallCsvScheduler: callCsvScheduler,
  CompanyService,
  ConditionalRoute: conditionalRoute,
  ConferenceRoom,
  Country,
  Ddi,
  Extension,
  ExternalCallFilter,
  Fax,
  Friend,
  HuntGroup,
  Ivr,
  Locution,
  MatchList,
  MusicOnHold,
  OutgoingDdiRule,
  PickUpGroup,
  Queue,
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

Object.freeze(entities);

export default entities;
