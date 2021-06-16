
import Calendar from './Calendar/Calendar';
import BillableCall from './BillableCall/BillableCall';
import Terminal from './Terminal/Terminal';
import User from './User/User';
import Extension from './Extension/Extension';
import Ddi from './Ddi/Ddi';
import Ivr from './Ivr/Ivr';
import HuntGroup from './HuntGroup/HuntGroup';
import EntityInterface from 'entities/EntityInterface';

interface EntityList {
  [name:string]: EntityInterface
}

const entities:EntityList = {
  Calendar,
  BillableCall,
  Terminal,
  User,
  Extension,
  Ddi,
  Ivr,
  HuntGroup,
};

export default entities;
