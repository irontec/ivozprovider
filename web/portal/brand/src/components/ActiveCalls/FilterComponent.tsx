import { ActionsSpec, PropertyList } from '@irontec/ivoz-ui';
import ListContentHeader from '@irontec/ivoz-ui/components/List/Content/ListContentHeader';
import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import useCurrentPathMatch from '@irontec/ivoz-ui/hooks/useCurrentPathMatch';
import EntityService from '@irontec/ivoz-ui/services/entity/EntityService';
import { useTheme } from '@mui/material';
import useMediaQuery from '@mui/material/useMediaQuery';
import { memo, useMemo } from 'react';
import { useLocation } from 'react-router-dom';

import ActiveCalls from '../../entities/ActiveCalls/ActiveCalls';

const FilterComponentMemo = memo(
  function FilterComponent(): JSX.Element {
    const [, cancelToken] = useCancelToken();
    const location = useLocation();
    const match = useCurrentPathMatch();

    const mobile = useMediaQuery(useTheme().breakpoints.down('md'));

    const entityService = useMemo(() => {
      const actions: ActionsSpec = {
        get: {
          collection: {
            'Company-collection': {
              paths: ['/active_calls'],
              parameters: [
                {
                  name: 'Company',
                  in: 'query',
                  required: false,
                  type: 'string',
                },
                {
                  name: 'Carrier',
                  in: 'query',
                  required: false,
                  type: 'string',
                },
                {
                  name: 'Direction',
                  in: 'query',
                  required: false,
                  type: 'string',
                },
                {
                  name: 'DdiProvider',
                  in: 'query',
                  required: false,
                  type: 'string',
                },
              ],
              properties: {
                Company: {
                  type: 'integer',
                },
                Carrier: {
                  type: 'integer',
                },
                Direction: {
                  enum: ['Inbound', 'Outbound'],
                  type: 'string',
                },
                DdiProvider: {
                  type: 'integer',
                },
              },
              required: [],
              type: 'object',
            },
          },
        },
      };

      return new EntityService(
        actions,
        ActiveCalls.properties as PropertyList,
        ActiveCalls
      );
    }, []);

    return (
      <ListContentHeader
        path={'/active_calls'}
        parentRow={undefined}
        ignoreColumn={undefined}
        entityService={entityService}
        preloadData={true}
        cancelToken={cancelToken}
        match={match}
        location={location}
        selectedValues={[]}
        mobile={mobile}
      />
    );
  },
  () => true
);

export default FilterComponentMemo;
