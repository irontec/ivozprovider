import { FkChoices } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterTypeArgs } from '@irontec/ivoz-ui/entities/EntityInterface';
import EntityService from '@irontec/ivoz-ui/services/entity/EntityService';
import axios from 'axios';
import { useEffect, useState } from 'react';
import { PathMatch } from 'react-router-dom';

import SelectOptions, {
  UnassignedServiceSelectOptions,
} from '../Service/SelectOptions';
import { CompanyServicePropertyList } from './CompanyServiceProperties';

type CompanyServiceForeignKeyGetterType = (
  props: ForeignKeyGetterTypeArgs,
  currentServiceId?: number
) => Promise<unknown>;

export const foreignKeyGetter: CompanyServiceForeignKeyGetterType = async (
  { cancelToken, filterContext },
  currentServiceId
): Promise<unknown> => {
  const response: CompanyServicePropertyList<unknown> = {};
  const promises: Array<Promise<unknown>> = [];

  if (!filterContext) {
    promises[promises.length] = UnassignedServiceSelectOptions(
      {
        callback: (options) => {
          response.service = options;
        },
        cancelToken,
      },
      {
        includeId: currentServiceId,
      }
    );
  } else {
    promises[promises.length] = SelectOptions({
      callback: (options) => {
        response.service = options;
      },
      cancelToken,
    });
  }

  await Promise.all(promises);

  return response;
};

interface useFkChoicesArgs {
  entityService: EntityService;
  currentServiceId?: number;
  match: PathMatch;
}

const useFkChoices = (props: useFkChoicesArgs): FkChoices => {
  const { entityService, currentServiceId, match } = props;
  const [fkChoices, setFkChoices] = useState<FkChoices>({});

  useEffect(() => {
    let mounted = true;

    const CancelToken = axios.CancelToken;
    const source = CancelToken.source();

    foreignKeyGetter(
      {
        cancelToken: source.token,
        entityService,
        row: {},
        match,
      },
      currentServiceId
    ).then((options) => {
      if (!mounted) {
        return;
      }

      setFkChoices((fkChoices) => {
        return {
          ...fkChoices,
          ...options,
        };
      });
    });

    return () => {
      mounted = false;
      source.cancel();
    };
  }, [currentServiceId, entityService, match]);

  return fkChoices;
};

export default useFkChoices;
