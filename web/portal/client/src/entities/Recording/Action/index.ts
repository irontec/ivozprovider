import { CustomActionsType } from '@irontec/ivoz-ui/entities/EntityInterface';

import Download from './Download';
import ExportCsv from './ExportCsv';

const customAction: CustomActionsType = {
  Export: {
    action: Download,
    multiselect: true,
  },
  ExportCsv: {
    action: ExportCsv,
    global: true,
  },
};

export default customAction;
