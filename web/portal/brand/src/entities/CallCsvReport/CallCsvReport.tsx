import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import SummarizeIcon from '@mui/icons-material/Summarize';

import {
  CallCsvReportProperties,
  CallCsvReportPropertyList,
} from './CallCsvReportProperties';

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
  title: _('Call CSV Report', { count: 2 }),
  path: '/call_csv_reports',
  toStr: (row: CallCsvReportPropertyList<EntityValues>) => `${row.id}`,
  properties,
  columns: ['csv', 'inDate', 'outDate', 'createdOn', 'sentTo'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'CallCsvReports',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default CallCsvReport;
