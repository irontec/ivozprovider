import { CustomActionsType } from '@irontec/ivoz-ui/entities/EntityInterface';

import Import from './Import';

const customAction: CustomActionsType = {
  Import: {
    action: Import,
    global: true,
  },
};

export default customAction;
