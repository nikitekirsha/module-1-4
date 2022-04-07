<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/core/Model.php';

	class AppModel extends Model {
		/* == apps == */

		// get all

		public function getAll() {
			return $this->db->query('select * from apps')->fetchAll();
		}

		// add one

		public function addApp($userId, $catId, $name, $text, $photo, $created) {
			return $this->db->prepare('insert into apps (user_id, cat_id, name, text, photo, created) values (:userId, :catId, :name, :text, :photo, :created)')->execute(['userId' => $userId, 'catId' => $catId, 'name' => $name, 'text' => $text, 'photo' => $photo, 'created' => $created]);
		}

		// delete one

		public function delApp($id) {
			return $this->db->prepare('delete from apps where id = :id')->execute(['id' => $id]);
		}

		/* == categories == */

		// get all

		public function getCats() {
			return $this->db->query('select * from app_cats')->fetchAll();
		}

		// get one

		public function getCat($id) {
			$query = $this->db->prepare('select name from app_cats where id = :id');
			$query->execute(['id' => $id]);

			return $query->fetchColumn();
		}

		// add one

		public function addCat($name) {
			$query = $this->db->prepare('insert into app_cats (name) values (:name)');
			
			return $query->execute(['name' => $name]);
		}

		// delete one

		public function delCat($id) {
			return $this->db->prepare('delete from app_cats where id = :id')->execute(['id' => $id]);
		}
	}