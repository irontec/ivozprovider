import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import store from 'store';

import { TerminalPropertiesList } from './TerminalProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<TerminalPropertiesList> {
  const entities = store.getState().entities.entities;
  const { TerminalModel } = entities;

  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    skip: ['terminalModel'],
  });

  promises.push(
    genericForeignKeyResolver({
      data,
      fkFld: 'terminalModel',
      entity: TerminalModel,
      addLink: TerminalModel.acl.update,
      cancelToken,
    })
  );

  await Promise.all(promises);

  return data;
};

export default foreignKeyResolver;
