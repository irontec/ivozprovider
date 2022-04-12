import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import entities from '../index';
import { TerminalPropertiesList } from './TerminalProperties';

const foreignKeyResolver: foreignKeyResolverType = async function (
  { data, cancelToken },
): Promise<TerminalPropertiesList> {

  const promises = [];
  const { TerminalModel } = entities;

  promises.push(
    genericForeignKeyResolver({
      data,
      fkFld: 'terminalModel',
      entity: TerminalModel,
      addLink: TerminalModel.acl.update,
      cancelToken,
    }),
  );

  await Promise.all(promises);

  return data;
};

export default foreignKeyResolver;