<?php

namespace App\Http\Controllers\Api\Private\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class CityController extends Controller
{
    /**
     * Liste toutes les villes (GET /api/cities)
     */
    public function index()
    {
        try {
            $cities = City::all();
            
            return response()->json([
                'status' => 'success',
                'data' => $cities,
                'message' => 'Liste des villes récupérée avec succès'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la récupération des villes'
            ], 500);
        }
    }

    /**
     * Crée une nouvelle ville (POST /api/cities)
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255|unique:cities,name'
            ],
            [
                'name.required' => 'Le nom de la ville est obligatoire.',
                'name.string' => 'Le nom doit être une chaîne de caractères.',
                'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
                'name.unique' => 'Cette ville existe déjà.'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
                'message' => 'Erreur de validation'
            ], 422);
        }

        try {
            $city = City::create([
                'id' => Str::uuid(),
                'name' => $request->name
            ]);

            return response()->json([
                'status' => 'success',
                'data' => $city,
                'message' => 'Ville créée avec succès'
            ], 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la création de la ville'
            ], 500);
        }
    }

    /**
     * Affiche une ville spécifique (GET /api/cities/{id})
     */
    public function show($id)
    {
        try {
            $city = City::find($id);

            if (!$city) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ville non trouvée'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $city,
                'message' => 'Ville récupérée avec succès'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la récupération de la ville'
            ], 500);
        }
    }

    /**
     * Met à jour une ville (PUT/PATCH /api/cities/{id})
     */
    public function update(Request $request, $id)
    {
        try {
            $city = City::find($id);

            if (!$city) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ville non trouvée'
                ], 404);
            }

            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|string|max:255|unique:cities,name,'.$id
                ],
                [
                    'name.required' => 'Le nom de la ville est obligatoire.',
                    'name.string' => 'Le nom doit être une chaîne de caractères.',
                    'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
                    'name.unique' => 'Cette ville existe déjà.'
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors(),
                    'message' => 'Erreur de validation'
                ], 422);
            }

            $city->update([
                'name' => $request->name
            ]);

            return response()->json([
                'status' => 'success',
                'data' => $city,
                'message' => 'Ville mise à jour avec succès'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la mise à jour de la ville'
            ], 500);
        }
    }

    /**
     * Supprime une ville (DELETE /api/cities/{id})
     */
    public function destroy($id)
    {
        try {
            $city = City::find($id);

            if (!$city) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ville non trouvée'
                ], 404);
            }

            // Vérification des dépendances (si nécessaire)
            if ($city->events()->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Impossible de supprimer : la ville est associée à des événements'
                ], 400);
            }

            $city->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Ville supprimée avec succès'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la suppression de la ville'
            ], 500);
        }
    }
}
