import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { CallCsvReportProperties } from './CallCsvReportProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: CallCsvReportProperties = {
  'id': {
    label: _('Id'),
  },
  'inDate': {
    label: _('In Date'),
  },
  'outDate': {
    label: _('Out Date'),
  },
  'csv': {
    label: _('Csv'),
  },
  'createdOn': {
    label: _('Created On'),
  },
  'sentTo': {
    label: _('Sent To'),
  },
  'callCsvScheduler': {
    label: _('Call CsvScheduler'),
  },
  'brand': {
    label: _('Brand'),
  },
};

const CallCsvReport: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'CallCsvReport',
  title: _('CallCsvReport', { count: 2 }),
  path: '/CallCsvReports',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default CallCsvReport;