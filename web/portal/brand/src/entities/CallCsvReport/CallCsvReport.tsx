import SummarizeIcon from '@mui/icons-material/Summarize';
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
    label: _('Out date'),
    format: 'date-time',
  },
  createdOn: {
    label: _('Created on'),
    format: 'date-time',
  },
  csv: {
    label: 'CSV',
    type: 'file',
    //@TODO callCsvReportsCsvDownload_command::${auth.acls.CallCsvReports.read}
  },
  sentTo: {
    label: _('Sent to'),
    readOnly: true,
  },
  callCsvScheduler: {
    label: _('Call CSV Scheduler', { count: 1 }),
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
  icon: SummarizeIcon,
  iden: 'CallCsvReport',
  title: _('Call Csv Report', { count: 2 }),
  path: '/call_csv_reports',
  toStr: (row: any) => row.id,
  properties,
  columns: ['csv', 'inDate', 'outDate', 'createdOn', 'sentTo'],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default CallCsvReport;
