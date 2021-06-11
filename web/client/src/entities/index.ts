
import Calendar from './Calendar/Calendar';
import BillableCall from './BillableCall/BillableCall';
import Terminal from './Terminal/Terminal';
import User from './User/User';
import EntityInterface from 'entities/EntityInterface';

interface EntityList {
  [name:string]: EntityInterface
}

const entities:EntityList = {
  Calendar,
  BillableCall,
  Terminal,
  User
};

export default entities;
