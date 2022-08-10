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
  inDate: {
    label: _('In date'),
    format: 'date-time',
  },
  outDate: {
    label: _('Out Date'),
    format: 'date-time',
  },
  csv: {
    label: _('Csv'),
  },
  createdOn: {
    label: _('Created on'),
    format: 'date-time',
  },
  csv: {
    label: 'CSV',
    //@TODO callCsvReportsCsvDownload_command::${auth.acls.CallCsvReports.read}
  },
  sentTo: {
    label: _('Sent to'),
    readOnly: true,
  },
  callCsvScheduler: {
    label: _('Call CsvScheduler'),
  },
  company: {
    label: _('Client'),
  },
  brand: {
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
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default CallCsvReport;
