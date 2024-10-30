import { CustomActionsType } from '@irontec/ivoz-ui/entities/EntityInterface';

import Download from './Download';

const customAction: CustomActionsType = {
  Export: {
    action: Download,
    multiselect: true,
  },
};

export default customAction;
