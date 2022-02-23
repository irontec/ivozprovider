import { useState, useEffect, useCallback } from 'react';
import FilterDrawer from './FilterDrawer';
import EntityService from 'lib/services/entity/EntityService';
import { StyledDivider } from './ContentFilter.styles';
import StyledContentFilterSelector from './ContentFilterSelector.styles';
import { SearchFilterType } from './icons/FilterIconFactory';
import { FilterCriteria } from './FilterCriteria';
import { useStoreState, useStoreActions } from 'store';
import { CancelToken } from 'axios';

export interface CriteriaFilterValue {
    name: string,
    type: SearchFilterType,
    value: string | number | boolean,
}

export type CriteriaFilterValues = Array<CriteriaFilterValue>;

interface ContentFilterMenuProps {
    entityService: EntityService,
    open: boolean,
    handleClose: () => void,
    path: string,
    preloadData: boolean,
    ignoreColumn: string | undefined,
    cancelToken: CancelToken,
}

export function ContentFilter(props: ContentFilterMenuProps): JSX.Element | null {

    const {
        entityService,
        open,
        handleClose,
        path,
        preloadData,
        ignoreColumn,
        cancelToken
    } = props;

    const queryStringCriteria: CriteriaFilterValues = useStoreState(
        (state) => state.route.queryStringCriteria
    );
    const setQueryStringCriteria = useStoreActions((actions) => {
        return actions.route.setQueryStringCriteria;
    });

    const [loading, setLoading] = useState<boolean>(true);
    const [foreignEntities, setForeignEntities] = useState<any>({});
    const [criteria, setCriteria] = useState<CriteriaFilterValues>(queryStringCriteria);

    useEffect(
        () => {
            setCriteria(queryStringCriteria);
        },
        [queryStringCriteria, setCriteria]
    );

    const [delayedApply, setDelayedApply] = useState<boolean>(false);
    const foreignKeyGetter = entityService.getForeignKeyGetter();

    const apply = useCallback(
        (waitForStateUpdate: boolean) => {

            if (waitForStateUpdate) {
                setDelayedApply(true);
                return;
            }

            setQueryStringCriteria(criteria);
            setDelayedApply(false);
            handleClose();
        },
        [criteria, handleClose, setQueryStringCriteria]
    );

    useEffect(
        () => {
            if ((preloadData || open) && loading) {
                foreignKeyGetter({
                    entityService,
                    cancelToken
                })
                .then((foreignEntities: any) => {
                    setForeignEntities(foreignEntities);
                    setLoading(false);
                });
            }
        },
        [preloadData, open, loading, foreignKeyGetter, entityService, cancelToken]
    );

    useEffect(
        () => {
            if (delayedApply) {
                apply(false);
            }
        },
        [delayedApply, criteria, apply]
    );

    const addCriteria = (data: CriteriaFilterValue) => {
        const newCriteria: CriteriaFilterValues = [...criteria, data];
        setCriteria(newCriteria);
    }

    const localRemoveFilter = (index: number) => {

        const newCriteria = [
            ...criteria
        ];
        newCriteria.splice(index, 1);
        setCriteria(newCriteria);
    }

    const removeFilter = (index: number) => {
        localRemoveFilter(index)
        apply(true);
    }

    return (
        <>
            <FilterDrawer
                open={open}
                close={handleClose}
                apply={apply}
            >
                <>
                    <StyledContentFilterSelector
                        entityService={entityService}
                        fkChoices={foreignEntities}
                        addCriteria={addCriteria}
                        ignoreColumn={ignoreColumn}
                        apply={apply}
                        path={path}
                    />
                    <StyledDivider />
                    <FilterCriteria
                        criteria={criteria}
                        entityService={entityService}
                        fkChoices={foreignEntities}
                        removeFilter={localRemoveFilter}
                        path={path}
                    />
                </>
            </FilterDrawer>
            <FilterCriteria
                criteria={queryStringCriteria}
                entityService={entityService}
                fkChoices={foreignEntities}
                removeFilter={removeFilter}
                path={path}
            />
        </>
    );
}

