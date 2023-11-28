import { CustomActionsType } from '@irontec/ivoz-ui/entities/EntityInterface';

import Export from './Export';

const customAction: CustomActionsType = {
  Export: {
    action: Export,
    global: true,
  },
};

export default customAction;
