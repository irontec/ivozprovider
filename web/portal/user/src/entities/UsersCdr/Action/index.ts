import { CustomActionsType } from '@irontec/ivoz-ui/entities/EntityInterface';

import Export from './Export';

const customAction: CustomActionsType = {
  Export: {
    action: Export,
    multiselect: true,
  },
};

export default customAction;
