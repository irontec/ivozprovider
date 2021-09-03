import EntityInterface from 'entities/EntityInterface';
import Calendar from './Calendar/Calendar';
import Country from './Country/Country';
import BillableCall from './BillableCall/BillableCall';
import Terminal from './Terminal/Terminal';
import TerminalModel from './TerminalModel/TerminalModel';
import User from './User/User';
import Extension from './Extension/Extension';
import Ddi from './Ddi/Ddi';
import Ivr from './Ivr/Ivr';
import HuntGroup from './HuntGroup/HuntGroup';
import Queue from './Queue/Queue';
import conditionalRoute from './ConditionalRoute/ConditionalRoute';
import Friend from './Friend/Friend';
import ConferenceRoom from './ConferenceRoom/ConferenceRoom';
import ExternalCallFilter from './ExternalCallFilter/ExternalCallFilter';
import Schedule from './Schedule/Schedule';
import MatchList from './MatchList/MatchList';
import RouteLock from './RouteLock/RouteLock';
import OutgoingDdiRule from './OutgoingDdiRule/OutgoingDdiRule';
import PickUpGroup from './PickUpGroup/PickUpGroup';
import callAcl from './CallAcl/CallAcl';
import Locution from './Locution/Locution';
import MusicOnHold from './MusicOnHold/MusicOnHold';
import Fax from './Fax/Fax';
import CompanyService from './CompanyService/CompanyService';
import RatingProfile from './RatingProfile/RatingProfile';
import UsersCdr from './UsersCdr/UsersCdr';
import callCsvScheduler from './CallCsvScheduler/CallCsvScheduler';
import Recording from './Recording/Recording';
import ResidentialDevice from './ResidentialDevice/ResidentialDevice';
import RetailAccount from './RetailAccount/RetailAccount';
import Service from './Service/Service';

interface EntityList {
  [name: string]: EntityInterface
}

const entities: EntityList = {
  Calendar,
  Country,
  BillableCall,
  Terminal,
  TerminalModel,
  User,
  Extension,
  Ddi,
  Ivr,
  HuntGroup,
  Queue,
  ConditionalRoute: conditionalRoute,
  Friend,
  ConferenceRoom,
  ExternalCallFilter,
  Schedule,
  MatchList,
  RouteLock,
  OutgoingDdiRule,
  PickUpGroup,
  CallAcl: callAcl,
  Locution,
  MusicOnHold,
  Fax,
  CompanyService,
  Service,
  RatingProfile,
  UsersCdr,
  CallCsvScheduler: callCsvScheduler,
  Recording,
  ResidentialDevice,
  RetailAccount,
};

export default entities;
